<?php

/**
 * This is the model class for table "{{msgboard}}".
 *
 * The followings are the available columns in table '{{msgboard}}':
 * @property integer $mid
 * @property integer $uid
 * @property string $username
 * @property string $email
 * @property string $content
 * @property integer $dateline
 * @property integer $status
 * @property integer $appid
 */
class Msgboard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Msgboard the static model class
	 */
	public $verifyCode;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{msgboard}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, content, appid', 'required'),
			array('email', 'email'),
			array('email', 'length', 'max'=>100),
			array('uid, dateline, status, appid', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mid, uid, username, email, content, dateline, status, appid', 'safe', 'on'=>'search'),
			array('verifyCode' , 'captcha','allowEmpty' => !CCaptcha::checkRequirements(), 'on'=>'Msgboard'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mid' => 'Id',
			'uid' => 'Uid',
			'username' => Yii::t('Base','NickName'),
			'email' => Yii::t('Base','Email'),
			'content' => Yii::t('Base','Message'),
			'dateline' => '时间',
			'status' => '匿名',
			'appid' => Yii::t('Base','App'),
			'verifyCode' => '验证码',
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

		$criteria->compare('mid',$this->mid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('status',$this->status);
		$criteria->compare('appid',$this->appid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeSave() {
		$this->dateline = time();
		parent::beforeSave();

		return true;
	}
}