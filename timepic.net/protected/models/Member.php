<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property integer $uid
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $openID
 * @property integer $openIDType
 * @property string $accessToken
 * @property integer $lastlogin
 * @property string $avatar
 * @property string $ip
 * @property integer $dateline
 * @property integer $isAuth
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{member}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, openID, openIDType, dateline', 'required'),
			array('openIDType, lastlogin, dateline, isAuth', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>100),
			array('openID', 'length', 'max'=>30),
			array('accessToken, avatar', 'length', 'max'=>255),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, username, password, email, openID, openIDType, accessToken, lastlogin, avatar, ip, dateline, isAuth', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'chinchillaTrades'=>array(self::HAS_MANY, 'ChinchillaMarketTrade', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'openID' => 'Open',
			'openIDType' => 'Open Idtype',
			'accessToken' => 'Access Token',
			'lastlogin' => 'Lastlogin',
			'avatar' => 'Avatar',
			'ip' => 'Ip',
			'dateline' => 'Dateline',
			'isAuth' => 'Is Auth',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('openID',$this->openID,true);
		$criteria->compare('openIDType',$this->openIDType);
		$criteria->compare('accessToken',$this->accessToken,true);
		$criteria->compare('lastlogin',$this->lastlogin);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('isAuth',$this->isAuth);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMemberInfo($uid){
		$memberInfo = $this->findByPk($uid);
		return $memberInfo->attributes;

	}
    
    public function getMemberHomeUrl($openID, $openIDType){
        if ($openID && $openIDType) {
            if (!empty(Yii::app()->params['openIds'][$openIDType])) {
                $url = Yii::app()->params['openIds'][$openIDType]['url'].$openID;
                return $url;
            };
        }
        return '';
    }
    
    public function sendWB($uid, $text, $image="", $url=""){
        if ($uid && $text) {
            Yii::import('ext.openID.SDK.sina.SaeTOAuthV2');
            Yii::import('ext.openID.SDK.sina.SaeTClientV2');
            if (is_array($uid)) {
                foreach($uid as $uidItem){
                    $memberInfo = Member::model()->getMemberInfo($uidItem);
                    if ($memberInfo) {
                        //sina
                        $openIdInfo = Yii::app()->params['openIds'][$memberInfo['openIDType']];
                        $openClient = new SaeTClientV2($openIdInfo['akey'], $openIdInfo['skey'], $memberInfo['accessToken']);
                        if ($url) {
                            $wbResult = $openClient->oauth->get('short_url/shorten', array('url_long' => $url));
                            $text .= $wbResult['urls'][0]['url_short'];
                        }
                        if ($image) {
                            $openClient->upload($text, $image);
                        } else {
                            $openClient->update($text);
                        }
                    }
                }
            }else{
                $memberInfo = Member::model()->getMemberInfo($uid);
                if ($memberInfo) {
                    //sina
                    $openIdInfo = Yii::app()->params['openIds'][$memberInfo['openIDType']];
                    $openClient = new SaeTClientV2($openIdInfo['akey'], $openIdInfo['skey'], $memberInfo['accessToken']);
                    if ($url) {
                        $wbResult=$openClient->oauth->get( 'short_url/shorten', array('url_long'=>$url));
                        $text .= $wbResult['urls'][0]['url_short'];
                    }
                    if ($image) {
                        $openClient->upload($text, $image);
                    }else{
                        $openClient->update($text);   
                    }
                }
            }
        }
        return false;
    }
}