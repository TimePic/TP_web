<?php

class MsgboardController extends TPController
{
	public function init() {
		parent::init();
		$this->pageTitle = 'TimePic'.'-'.Yii::t('Base','isue');
	}
	
	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'captcha'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF, //背景颜色
				'transparent' => true, //显示为透明
				'testLimit' => 2,
			),
		);
	}
	
	public function actionIndex()
	{
		$model = new Msgboard('Msgboard');
		
		$sql = "SELECT username, email, content, dateline, appid  FROM {{msgboard}} ORDER BY dateline DESC";
		$criteria = new CDbCriteria();
		$result = Yii::app()->db->createCommand($sql)->query();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$msgs=$result->query();
		//pro the post
		if ($_POST['Msgboard']) {
			$model->attributes = $_POST['Msgboard'];			
			$model->save();
			$this->refresh();
			Yii::app()->end();
		}
		
		$this->render('index',
				array('model'=>$model,
						'msgs'=>$msgs,
						'pages'=>$pages,
					)
				);
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
	*/

	
}