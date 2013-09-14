<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class TPUserIdentity extends CUserIdentity {

        public $id;
        public $uid;
        public $username;
        public $email;
        public $openID;
        public $openIDType;
        public $accessToken;
        public $lastlogin;
        public $avatar;
        public $ip;
        public $dateline;
        public $password;
        public $isAuth;

        public function __construct($openIDType) {
                $this->username = "";
                $this->openIDType = $openIDType;
                $this->accessToken = Yii::app()->session['openIdToken']['access_token'];
                $this->lastlogin = time();
                $this->ip = Yii::app()->request->userHostAddress;
                $this->dateline = time();
        }

        /**
         * Authenticates a user.
         * The example implementation makes sure if the username and password
         * are both 'demo'.
         * In practical applications, this should be changed to authenticate
         * against some persistent user identity storage (e.g. database).
         * @return boolean whether authentication succeeds.
         */
        public function getId() {
                return $this->id;
        }
        
        public function getName() {
                return $this->username;
        }
        
        public function authenticate() {
                $this->setState('uid', $this->uid);
                $this->setState('username', $this->username);
                $this->setState('email', $this->email);
                $this->setState('openID', $this->openID);
                $this->setState('openIDType', $this->openIDType);
                $this->setState('accessToken', $this->accessToken);
                $this->setState('lastlogin', $this->lastlogin);
                $this->setState('avatar', $this->avatar);
                $this->setState('ip', $this->ip);
                $this->setState('dateline', $this->dateline);
                $this->setState('isAuth', $this->isAuth);
                if (in_array($this->uid, Yii::app()->params['adminUid'])) {
                   $this->setState('adminid', 1);     
                }
                $this->errorCode = self::ERROR_NONE;
                return!$this->errorCode;
        }
        
        //authenticate the openID user
        public function openIdAuthenticate() {
                switch ($this->openIDType) {
                        case 1:
                                Yii::import('ext.openID.SDK.sina.SaeTOAuthV2');
                                Yii::import('ext.openID.SDK.sina.SaeTClientV2');
                                $openIdInfo = Yii::app()->params['openIds']['1'];
                                $openClient = new SaeTClientV2($openIdInfo['akey'], $openIdInfo['skey'], $this->accessToken);
                                $uid_get = $openClient->get_uid();
                                $uid = $uid_get['uid'];
                                $user_message = $openClient->show_user_by_id($uid); //根据ID获取用户等基本信息
                                $this->username = $user_message['screen_name'];
                                $this->openID = $uid;
                                $this->avatar = $user_message['profile_image_url'];
                                break;
                        default:
                                break;
                }
                
                $model = new Member();

                $userInfo = $model->find('openIDType=:openIDType and openID=:openID', array(':openIDType' => $this->openIDType, ':openID' => $this->openID));
                if (empty($userInfo)) {
                        $model->username = $this->username;
                        $model->password = time();
                        $model->openID = $this->openID;
                        $model->openIDType = $this->openIDType;
                        $model->accessToken = $this->accessToken;
                        $model->lastlogin = $this->lastlogin;
                        $model->avatar = $this->avatar;
                        $model->ip = $this->ip;
                        $model->dateline = $this->dateline;
                        $model->isAuth = 1;
                        if ($model->save()) {
                                $this->id = $model->uid;
                                $this->uid = $model->uid;
                                $this->isAuth = $model->isAuth;
                        }else{
                              echo "update user infomation failed!";
                              Yii::app()->end();
                        };
                } else {
                        $model->updateByPk($userInfo->uid, array('username'=>$this->username, 'accessToken'=>$this->accessToken, 'lastlogin'=>$this->lastlogin, 'avatar'=>$this->avatar, 'ip'=>$this->ip, 'isAuth'=> 1));                
                
                        $this->id = $userInfo->uid;
                        $this->uid = $userInfo->uid;  
                        $this->isAuth = 1;
                }
                //authen the user
                return $this->authenticate();
        }

}