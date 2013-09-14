<?php

class TPUserController extends Controller {

        public function actionIndex() {
                echo '1111';
                Yii::app()->end();
                $this->render('index');
        }

        public function actionSinaLogin() {
                
                Yii::import('ext.openID.SDK.sina.SaeTOAuthV2');
                //sina login type code is 1
                $openIdInfo = Yii::app()->params['openIds']['1'];
                $openService = new SaeTOAuthV2($openIdInfo['akey'] , $openIdInfo['skey']);
                $code = Yii::app()->request->getParam('code');
                
                if (isset($code)) {
                        $keys = array();
                        $keys['code'] = $code;
                        $keys['redirect_uri'] = $openIdInfo['callback'];
                        try {
                                $token = $openService->getAccessToken('code', $keys);
                        } catch (OAuthException $e) {
                                
                        }
                }
                if ($token) {
                        Yii::app()->session['openIdToken'] = $token;
                        setcookie('weibojs_' . $o->client_id, http_build_query($token));
                }
                //sina login openIDtype =1
                $identity = new TPUserIdentity(1);  
                ;
                if ($identity->openIdAuthenticate()) {
                    Yii::app()->user->login($identity, 7*24*3600);
                    echo 'Login successful';
                    $this->redirect('/');
                }else{
                    echo 'Login failed.';
                    $this->redirect('/');
                }
                
        }
        
        //logout
        public function actionLogout(){
             Yii::app()->user->logout();
             $this->redirect('/');
        }
        
        public function actionSinaCancelAuthorization(){
             $uid = Yii::app()->request->getParam('uid');
             if(intval($uid)){
		//sina
		$openIDType = 1;	
		Yii::app()->db->createCommand()->update('{{member}}', array('isAuth'=>'0'), 'openID=:openID and openIDType=:openIDType', array(':openID'=>$uid, ':openIDType'=>$openIDType));
		$logstr = "source:".Yii::app()->request->getParam('source')."|";
		$logstr .= "uid:".Yii::app()->request->getParam('uid')."|";
		$logstr .= "auth_end:".Yii::app()->request->getParam('auth_end')."|";
		$logstr .= "verification:".Yii::app()->request->getParam('verification')."|";
		$logstr .= "time:".date("Y-m-d H:i:s", time())."|";
             	Yii::log("actionSinaCancelAuthorization: ".$logstr, 'info', "timepic.log.SinaCancelAuthorization");
	     }
	     Yii::app()->end();	
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
