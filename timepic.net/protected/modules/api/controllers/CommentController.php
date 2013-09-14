<?php

class CommentController extends Controller
{
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF, //背景颜色
				'transparent' => true, //显示为透明
				'testLimit' => 3,
				'fixedVerifyCode' => '2345',//debug
			),
		);
	}
	
	public function actionIndex()
	{
		Yii::app()->end();
	}
	
	public function actionCreate(){
		
		$model = new Comment();
		if(isset($_POST['ajax'])&& $_POST['ajax']==='commentForm'){
				
			  echo CActiveForm::validate($model);

			  Yii::app()->end();

		}
		
		if ($_POST['Comment']) {
			$model->attributes = $_POST['Comment'];			
			if ($model->validate()) {
				$model->save();
				$html = $this->widget('application.components.widgets.TpCommentWidget',array(
				'idtype'=>'totoroPic',
				'id'=>'11211',
				'action' => Yii::app()->createUrl('/api/comment/create')
				),1);
				echo $html;
			}else{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

//			var_dump($model->getErrors());
			Yii::app()->end();
		}
		
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