<?php

class MarketController extends TPController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $pageTitle = 'TimePic-龙猫市场';
	public $translate = array();

	public function init(){
		//get chinchilla color translate data from the config/param
		 $this->translate = Yii::app()->getParams('chinchilla')->chinchilla['colorTranslate'];
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl -uploadTradePic',
            'accessControl -showTmpThumbnail',// perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'uploadTradePic'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'getChinchillaColor', 'showTmpThumbnail', 'tradeSwitch', 'deleteTradePic'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	// show chinchilla color by the imageid
	public function actionGetChinchillaColor($imageid){

		if (isset($imageid)) {
			$row = Yii::app()->db->createCommand()->select('*')->from('{{totoro_color}}')->where('imageid=:imageid', array(':imageid' => $imageid))->query()->read();
			//只有语言选择中文才开始翻译。
			if (Yii::app()->language == 'zh_cn') {
				$row['color'] = str_replace(array_keys($this->translate), $this->translate, $row['color']);	
			}
			if (isset($row['color'])) {
				echo $row['color'];
			}
		}
		Yii::app()->end();

	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        
        $model = ChinchillaMarketTrade::model()->with('author')->findByPk($id);
        $tradeImages = ChinchillaMarketTradePic::model()->findAll('tradeId=:tradeId', array(':tradeId'=>$model->tradeId));
        
        //该交易已经过期
        if ($model->expiredDate < time() && $model->displayorder >= 0) {
            $model->updateByPk($model->tradeId, array('displayorder'=>'-2'));
        }
        //更新浏览数
        $model->updateByPk($id, array('views'=>new CDbExpression('views+1')));
        
		$this->render('view',array(
			'model'=> $model,
            'tradeImages'=>$tradeImages,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{   
		$model=new ChinchillaMarketTrade;
           
		if(isset($_POST['ChinchillaMarketTrade']))
		{
            $cover = '';
            $uploadList = isset(Yii::app()->user->uploadList) ? Yii::app()->user->uploadList : array();
			$model->attributes=$_POST['ChinchillaMarketTrade'];
			$model->uid = Yii::app()->user->uid;
			$model->breed = Yii::app()->request->getParam('ChinchillaGVC');
			$model->dateline = time();
			$model->ip = Yii::app()->request->getUserHostAddress();
			$model->displayorder = 0;
            $model->contact = str_replace(array('，', ','), ',', $model->contact);
            //check breed color
            $colors = $model->checkColor($model->breed);
            $model->attributes = $colors;
            if($model->save()){
                if ($uploadList) {
                    Yii::import('application.components.UploadHelper');
                    $setCover = true;
                    foreach ($uploadList as $attachment){
                        $upload = new UploadHelper();
                        $upload->init($attachment, 'chinchillaMarket');
                        $upload->save();
                        $picmodel = new ChinchillaMarketTradePic();
                        $picmodel->uid = Yii::app()->user->uid;
                        $picmodel->tradeId = $model->tradeId;
                        $picmodel->ip = Yii::app()->request->getUserHostAddress();
                        $picmodel->filename = $upload->attach['name'];
                        $picmodel->type = $upload->attach['extension'];
                        $picmodel->size = $upload->attach['size'];
                        $picmodel->filepath = $upload->attach['attachment'];
                        $picmodel->thumb = 1;
                        $picmodel->status = 0;
                        $picmodel->dateline = time();
                        $picmodel->save();
                        //the cover will be the first element in the uploadList;
                        if ($setCover) {
                            $model->updateByPk($model->tradeId, array('pic'=>$picmodel->filepath));
                            $cover = $picmodel->filepath;
                            $setCover = false;
                        }
                        unset($upload);
                        unset($picmodel);
                    }
                }
                //reset the attachment list
                unset(Yii::app()->user->uploadList);
                $gender = $model->gender ? "MM" :"DD";
                //send new WB
                if (intval($_POST['ChinchillaMarketTrade']['syncWB'])) {
                    $wbText = " 发布龙猫交易【".$model->getChinchillaColor($model->breed)." ".$gender."】:".$model->title."，靠谱主人看过来，猫友们帮忙转起。@TimePic #TimePic龙猫市场# 来自TimePic龙猫市场";
                    Member::model()->sendWB(Yii::app()->user->uid, $wbText, CommonHelper::getImageByType($cover, 'chinchillaMarket', 'big'), $this->createAbsoluteUrl('/chinchilla/market/view', array('id'=>$model->tradeId)));
                }
				//synchroniz with WB robot
                $wbText = "@".Yii::app()->user->username." 发布龙猫交易【".$model->getChinchillaColor($model->breed)." ".$gender."】:".$model->title."，靠谱主人看过来，猫友们帮忙转起。@TimePic #TimePic龙猫市场# 来自TimePic龙猫市场。";
                Member::model()->sendWB(Yii::app()->params['robotMember'], $wbText, CommonHelper::getImageByType($cover, 'chinchillaMarket', 'big'), $this->createAbsoluteUrl('/chinchilla/market/view', array('id'=>$model->tradeId)));
                //be a barrer to form reposed
                $this->refresh(false);
                $this->redirect(array('view','id'=>$model->tradeId));
            }
		}
        //reset the attachment list
        unset(Yii::app()->user->uploadList);
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ChinchillaMarketTrade']))
		{
			$model->attributes=$_POST['ChinchillaMarketTrade'];
			$model->uid = Yii::app()->user->uid;
			$model->breed = Yii::app()->request->getParam('ChinchillaGVC');
            $model->contact = str_replace(array('，', ','), ',', $model->contact);
            //check breed color
            $colors = $model->checkColor($model->breed);
            $model->attributes = $colors;
            if($model->save()){
                $uploadList = isset(Yii::app()->user->uploadList) ? Yii::app()->user->uploadList : array();
                if ($uploadList) {
                    Yii::import('application.components.UploadHelper');
                    foreach ($uploadList as $attachment){
                        $upload = new UploadHelper();
                        $upload->init($attachment, 'chinchillaMarket');
                        $upload->save();
                        $picmodel = new ChinchillaMarketTradePic();
                        $picmodel->uid = Yii::app()->user->uid;
                        $picmodel->tradeId = $model->tradeId;
                        $picmodel->ip = Yii::app()->request->getUserHostAddress();
                        $picmodel->filename = $upload->attach['name'];
                        $picmodel->type = $upload->attach['extension'];
                        $picmodel->size = $upload->attach['size'];
                        $picmodel->filepath = $upload->attach['attachment'];
                        $picmodel->thumb = 1;
                        $picmodel->status = 0;
                        $picmodel->dateline = time();
                        $picmodel->save();
                        unset($upload);
                        unset($picmodel);
                    }
                }
                //reset the attachment list
                unset(Yii::app()->user->uploadList);
				$this->redirect(array('view','id'=>$model->tradeId));
            }
		}
        //reset the attachment list
        unset(Yii::app()->user->uploadList);
        //formate the time
        $model->birthday = date('Y/m/d', $model->birthday);
        $model->expiredDate = date('Y/m/d', $model->expiredDate);
        $tradeImages = ChinchillaMarketTradePic::model()->findAll('uid=:uid and tradeId=:tradeId', array(':uid'=>Yii::app()->user->uid, ':tradeId'=>$model->tradeId));
        $this->render('update',array(
			'model'=>$model,
            'tradeImages'=>$tradeImages,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//		}
//		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    /**
     * turn on or off the trade. 
     * if turning on,then the displayorder value  is 0
     * or turn off the trad which makes the dispalyorder value is equal to -2
     */
    public function actionTradeSwitch($id, $status){
        
        if (in_array($status, array('on', 'off'))) {
                $model = $this->loadModel($id);
                if ($status == 'on') {
                    $displayorder = '0';
                    $model->updateByPk($id, array('expiredDate'=>new CDbExpression('expiredDate+604800')),'uid=:uid', array(':uid'=>Yii::app()->user->uid));
                }else{
                    $displayorder = '-1';
                }

                $model->updateByPk($id, array('displayorder'=>$displayorder),'uid=:uid', array(':uid'=>Yii::app()->user->uid));
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin')); 
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser

        }
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

	/**
     * Lists all models.
     * @property integer $white
     * @property integer $black
     * @property integer $beige
     * @property integer $velvet
     * @property integer $violet
     * @property integer $sapphire
	 */
	public function actionIndex($color='-', $velvet='-', $gene='-', $gender='-', $weight='-', $price='-')
	{
        $whereStr = '';
        $whereParams = $linkParams = array();
        $linkParams = $_GET;
        //颜色
        if ($color != '-') {
            if ($color=='gray') {
                $whereParams['breed=:breed'][':breed'] = 600000;
            }elseif ($color=='white') {
                $whereParams['white>:white'][':white'] = 0;
            }elseif ($color=='black') {
                $whereParams['black>:black'][':black'] = 0;
            }elseif ($color=='beige') {
                $whereParams['beige>:beige'][':beige'] = 0;
            }
        }
        //丝绒
        if ($velvet != '-') {
            if (in_array($velvet, array(0,1))) {
                $whereParams['velvet=:velvet'][':velvet'] = $velvet;
            }
        }
        //隐性颜色
        if ($gene != '-') {
            if ($gene == 'sapphire') {
                $whereParams['sapphire>:sapphire'][':sapphire'] = 0;
            }elseif ($gene == 'violet') {
                $whereParams['violet>:violet'][':violet'] = 0;
            }elseif ($gene === 0) {
                $whereParams['sapphire=:sapphire'][':sapphire'] = 0;
                $whereParams['violet=:violet'][':violet'] = 0;
            }
        }
        //gender
        if ($gender != '-') {
            if (in_array($gender, array(0,1))) {
                $whereParams['gender=:gender'][':gender'] = $gender;
            }
        }
        //weight
        $weightList = array(
            1=>array('min'=>1, 'max'=>100),
            2=>array('min'=>100, 'max'=>300),
            3=>array('min'=>300, 'max'=>500),
            4=>array('min'=>500, 'max'=>600),
            5=>array('min'=>600, 'max'=>''),
            );

        if ($weight != '-') {
            if (in_array($weight, array(1,2,3,4,5,6))) {
                if ($weightList[$weight]['min']) {
                    $whereParams['weight>:weightMin'][':weightMin'] = $weightList[$weight]['min'];
                }
                if ($weightList[$weight]['max']) {
                    $whereParams['weight<=:weightMax'][':weightMax'] = $weightList[$weight]['max'];
                }
            }
        }
        //price
        $priceList = array(
            1=>array('min'=>1, 'max'=>400),
            2=>array('min'=>400, 'max'=>1000),
            3=>array('min'=>1000, 'max'=>2000),
            4=>array('min'=>2000, 'max'=>3000),
            5=>array('min'=>3000, 'max'=>4000),
            6=>array('min'=>5000, 'max'=>6000),
            7=>array('min'=>6000, 'max'=>''),
            );

        if ($price != '-') {
            if (in_array($price, array(1,2,3,4,5,6,7))) {
                if ($priceList[$price]['min']) {
                    $whereParams['price>:priceMin'][':priceMin'] = $priceList[$price]['min'];
                }
                if ($priceList[$price]['max']) {
                    $whereParams['price<=:priceMax'][':priceMax'] = $priceList[$price]['max'];
                }
            }
        }

		$model=new ChinchillaMarketTrade;
        $command = Yii::app()->db->createCommand();
        $command->select('count(tradeId)');
        $command->from('{{chinchilla_market_trade}}');

        if (!empty($whereParams)) {
            foreach ($whereParams as $whereStr => $whereParam) {
                $command->andWhere($whereStr, $whereParam);
            }
        }

        $criteria = new CDbCriteria();
		$pages=new CPagination($command->queryScalar());
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);

        $command = Yii::app()->db->createCommand();
        $command->select('tradeId, uid, gender, title, price, dateline, pic, views');
        $command->from('{{chinchilla_market_trade}}');
        if (!empty($whereParams)) {
            foreach ($whereParams as $whereStr => $whereParam) {
                $command->andWhere($whereStr, $whereParam);
            }
        }
        $command->order('dateline DESC');
        $command->limit($pages->pageSize, $pages->currentPage*$pages->pageSize);

		$query = $command->query();
		while($row = $query->read()){
			if ($row['uid']) {
				$row['memberInfo'] = Member::model()->getMemberInfo($row['uid']); 
			}
			$data[] = $row;
		}
		$this->render('index',
				array('model'=>$model,
                    'data'=>$data,
                    'pages'=>$pages,
                    'linkParams'=>$linkParams,
					)
				);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
//        $model = ChinchillaMarketTrade::model()->findAll('uid=:uid', array(':uid'=>Yii::app()->user->uid));
        $dataprovider = new CActiveDataProvider('ChinchillaMarketTrade', array(
                    'criteria' => array(
                        'condition' => 'uid='.Yii::app()->user->uid,
//                        'order' => 'dateline DESC',
                    ),
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                    'sort' => array(
                        'defaultOrder' => array('dateline'=>'CSort::SORT_DESC'),
                        'attributes' =>array(
                            'tradeId' => array(
                                'asc' => 'tradeId',
                                'desc' => 'tradeId DESC',
                                'label' => 'Id',
                            ),
                            'breed',
                            'gender' => array(
                                'asc' => 'gender',
                                'desc' => 'gender DESC',
                            ),
                            'weight' => array(
                                'asc' => 'weight',
                                'desc' => 'gender DESC',
                                'label'=>'体重(g)'
                            ),
                            'price' => array(
                                'asc' => 'price',
                                'desc' => 'price DESC',
                                'label'=>'价格(元)'
                            ),
                            'dateline',
                            'displayorder' => array(
                                'asc' => 'displayorder',
                                'desc' => 'displayorder DESC',
                                'label'=>'状态'
                            ),
                        ),
                    )
                )
        );
        
		$this->render('admin',array(
            'dataprovider'=>$dataprovider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ChinchillaMarketTrade::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='chinchilla-market-trade-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
    public function actionDeleteTradePic($id,$tradeId){
        if (intval($id) && intval($tradeId)) {
                $data = ChinchillaMarketTradePic::model()->findByPk($id, "uid=:uid and tradeId=:tradeId", array(":uid"=>Yii::app()->user->uid, 'tradeId'=>$tradeId));
                if ($data->picid) {
                    ChinchillaMarketTradePic::model()->deletePic($data->picid);
                }
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('update','id'=>$tradeId)); 
        }
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    /** 
     * multiupload images
     */
	public function actionUploadTradePic(){
		//this action should be access by anyone due the SWFUpload bug
		//you should modify the filters
		//		'accessControl -uploadTradePic',
  
        $uploadlist = array();
        $sessionCount = $dbCount = 0;
		if (Yii::app()->request->getParam('PHPSESSID')) {
            Yii::app()->session->close();
			$res = Yii::app()->session->setSessionID(Yii::app()->request->getParam('PHPSESSID'));
            Yii::app()->session->open();
		}
		// Check the upload
		if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
			echo "ERROR:invalid upload";
			Yii::app()->end();
		}
        if (isset(Yii::app()->user->uploadList)) {
            $uploadList = Yii::app()->user->uploadList; 
            $sessionCount = count($uploadList);
        }
        
        $tradeId = Yii::app()->request->getParam('tradeId');
        
        if ($tradeId) {
            $dbCount = ChinchillaMarketTradePic::model()->count('uid=:uid and tradeId=:tradeId', array(':uid'=>Yii::app()->user->uid, ':tradeId'=>$tradeId));
        }
        
        if (($sessionCount+$dbCount)>=4) {
			echo "ERROR: 图片最多上传4张";
			Yii::app()->end();
        }
        
        Yii::import('application.components.UploadHelper');
        $attach = $_FILES['Filedata'];
        $upload = new UploadHelper();
		$upload->init($attach);
        $upload->saveToTmp();


        $uploadList[$upload->attach['attachName']] = $upload->attach;
        Yii::app()->user->setState('uploadList', $uploadList);
        echo 'FILEID:'.$upload->attach['attachName'];
        Yii::app()->end();
	}
    
    /**
     * 
     * show Thumbnail in market create
     */
    public function actionShowTmpThumbnail(){
        $id = Yii::app()->request->getParam('id');
        if (empty($id)) {
            throw new CHttpException(500, 'No ID');
        }
        //resolve SWFUpload session problem
		if (Yii::app()->request->getParam('PHPSESSID')) {
            Yii::app()->session->close();
			$res = Yii::app()->session->setSessionID(Yii::app()->request->getParam('PHPSESSID'));
            Yii::app()->session->open();
		}

        
        if (!isset(Yii::app()->user->uploadList) || empty(Yii::app()->user->uploadList[$id]['copyTmp'])) {
            throw new CHttpException(404, 'No File');
        }
        $uploadList = Yii::app()->user->uploadList;
        $pathInfo = pathinfo(Yii::getPathOfAlias('webroot').$uploadList[$id]['copyTmp']);
        $thumbImage = $pathInfo['dirname'].'/'.'thumb'.'_'.$pathInfo['basename'];
        $image = file_get_contents($thumbImage);
        header("Content-type: image/jpeg");
        header("Content-Length: " . strlen($image));
        echo $image;
        Yii::app()->end();
    }
}
