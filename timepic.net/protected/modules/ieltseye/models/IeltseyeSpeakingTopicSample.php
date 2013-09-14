<?php

/**
 * This is the model class for table "{{ieltseye_speaking_topic_sample}}".
 *
 * The followings are the available columns in table '{{ieltseye_speaking_topic_sample}}':
 * @property integer $sampleid
 * @property string $content
 * @property string $author
 * @property string $email
 * @property integer $dateline
 * @property string $source
 * @property integer $displayorder
 * @property integer $cardid
 */
class IeltseyeSpeakingTopicSample extends CActiveRecord
{
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IeltseyeSpeakingTopicSample the static model class
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
		return '{{ieltseye_speaking_topic_sample}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, cardid', 'required'),
			array('dateline, displayorder, cardid', 'numerical', 'integerOnly'=>true),
			array('author', 'length', 'max'=>30),
            array('email', 'required', 'on'=>'userCreate'),
            array('email', 'email', 'on'=>'userCreate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'userCreate'),
			array('sampleid, content, author, email, dateline, source, displayorder, cardid', 'safe', 'on'=>'search'),
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
            'topicCard'=>array(self::BELONGS_TO, 'IeltseyeSpeakingTopicCard', 'cardid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sampleid' => 'Sampleid',
			'content' => 'Content',
			'author' => 'Author',
            'email' => 'Email',
			'dateline' => 'Dateline',
			'source' => 'Source',
			'displayorder' => 'Displayorder',
			'cardid' => 'Cardid',
            'verifyCode'=>'Verification Code', 
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

		$criteria->compare('sampleid',$this->sampleid);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('author',$this->author,true);
        $criteria->compare('email',$this->email,true);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('displayorder',$this->displayorder);
		$criteria->compare('cardid',$this->cardid);
//        search samples belong the cardid
        
        $cardid = Yii::app()->request->getParam('id') ? intval(Yii::app()->request->getParam('id')): 0;
        if ($cardid) {
            $criteria->condition = 't.cardid='.$cardid;
        }
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => array('dateline'=>'CSort::SORT_DESC'),
            )
		));
	}
    
	public function beforeSave(){
		$this->dateline = time();
		return true;
	}
}