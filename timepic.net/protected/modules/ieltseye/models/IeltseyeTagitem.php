<?php

/**
 * This is the model class for table "{{ieltseye_tagitem}}".
 *
 * The followings are the available columns in table '{{ieltseye_tagitem}}':
 * @property integer $tid
 * @property integer $tagid
 * @property string $tagname
 * @property integer $itemid
 * @property string $idtype
 */
class IeltseyeTagitem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IeltseyeTagitem the static model class
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
		return '{{ieltseye_tagitem}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tagid, itemid', 'numerical', 'integerOnly'=>true),
			array('tagname', 'length', 'max'=>20),
			array('idtype', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tid, tagid, tagname, itemid, idtype', 'safe', 'on'=>'search'),
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
            'tag' => array(self::BELONGS_TO, 'IeltseyeTag', 'tagid'),
            'card' => array(self::HAS_ONE, 'IeltseyeSpeakingTopicCard', array('cardid'=>'itemid'), 'together'=>true),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tid' => 'Tid',
			'tagid' => 'Tagid',
			'tagname' => 'Tagname',
			'itemid' => 'Itemid',
			'idtype' => 'Idtype',
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

		$criteria->compare('tid',$this->tid);
		$criteria->compare('tagid',$this->tagid);
		$criteria->compare('tagname',$this->tagname,true);
		$criteria->compare('itemid',$this->itemid);
		$criteria->compare('idtype',$this->idtype,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}