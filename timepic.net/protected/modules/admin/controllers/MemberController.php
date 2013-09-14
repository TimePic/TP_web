<?php

class MemberController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}
	

	public function accessRules() {
                return array(
                    array('allow', // allow all users to perform 'index' and 'view' actions
                        'actions' => array('login', 'logout'),
                        'users' => array('@'),
                        'expression' => array($this, 'isAdmin'),
                    ),
                    array('deny',
                        'actions' => array('index','login', 'logout'),
                        'users' => array('*'),
                    ),
                );
        }
        public function isAdmin($user){
                if (isset($user->adminid)) {
                     return true; 
                }
                return false;
        }
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF, //背景颜色
				'transparent' => true, //显示为透明
				'testLimit' => 4,
			),
		);
	}
	
	public function actionLogin()
	{
		$model=new AdminLoginForm;
                
                //如果自动登录 直接跳转后台
                if (!Yii::app()->user->isGuest && isset (Yii::app()->user->isLoginAdmin)) {
                    $this->redirect(array('/admin/'));
                }
                
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/admin/'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}