<?php

class TotoroPicController extends TPController
{
    public $pageTitle = '';
	
	public function init() {
		parent::init();
		$this->pageTitle = Yii::t('Base','seototoropic');
	}


	public function actionIndex()
	{	
            $sql = "SELECT COUNT(*) FROM {{totorotalk_photo}}";
            
            $count = Yii::app()->db->createCommand($sql)->queryScalar();
            $sql = "SELECT * FROM {{totorotalk_photo}} ORDER BY dateline DESC";
            $dataProvider = new CSqlDataProvider($sql, array(
                
                                    'totalItemCount'=>$count,
                                    'sort'=>array(
                                        'attributes'=>array(
                                            'dateline'=>'DESC'
                                        ),
                                     ),
                                    'pagination'=>array(
                                         'pageSize' => 30,
                                    ),
                                ));
            $this->render(
                            'index',
                            array('dataProvider'=>$dataProvider,)
                    );
	}
	
	//图片浏览页面
	public function actionView($id){
		$currentid = intval($id);
		$preid = $nextid = '';
		$preid = Yii::app()->db->createCommand()->select('pid')->from('{{totorotalk_photo}}')->where('pid<:pid', array(':pid'=>$currentid))->order('pid DESC')->limit('1')->query()->readColumn(0);
		
		$nextid = Yii::app()->db->createCommand()->select('pid')->from('{{totorotalk_photo}}')->where('pid>:pid', array(':pid'=>$currentid))->order('pid')->limit('1')->query()->readColumn(0);
		$currentPic = Yii::app()->db->createCommand()->select('*')->from('{{totorotalk_photo}}')->where('pid=:pid', array(':pid'=>$currentid))->queryRow();
		if ($currentPic) {
			$likeModel = new Like;
			$liketimes = $likeModel->getLike('totoroPic', $currentPic['pid']);
			$currentPic['liketimes'] = intval($liketimes);
		
		}
		//相关图片
		$relatePic = Yii::app()->db->createCommand()->select('*')->from('{{totorotalk_photo}}')->where('pid>=:pid ORDER BY pid ASC LIMIT 5', array(':pid'=>$currentid))->queryAll();
		
		//浏览次数
		$record = TotorotalkPhoto::model()->findByPk($currentid);
		if ($record) {
			$record->saveCounters(array('views'=>1));
		}
		$this->render(
                            'view', array('currentid' => $currentid,
                            'currentPic' => $currentPic,
                            'relatePic' => $relatePic,
                            'preid' => $preid,
                            'nextid' => $nextid,
                        )
                );
	}
	
	public function actionLike($id){
		$likeModel = new Like;
		echo $likeModel->setLike('totoroPic', $id);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}