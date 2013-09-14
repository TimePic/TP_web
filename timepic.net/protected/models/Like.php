<?php

/**
 * This is the model class for table "{{like}}".
 *
 * The followings are the available columns in table '{{like}}':
 * @property integer $lid
 * @property integer $times
 * @property integer $typeid
 * @property string $type
 */
class Like extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Like the static model class
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
		return '{{like}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('times, typeid, type', 'required'),
			array('times, typeid', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lid, times, typeid, type', 'safe', 'on'=>'search'),
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
			'lid' => 'Lid',
			'times' => 'Times',
			'typeid' => 'Typeid',
			'type' => 'Type',
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

		$criteria->compare('lid',$this->lid);
		$criteria->compare('times',$this->times);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//增加喜欢数
	public function setLike($type, $typeid){
		
		$likedata = array();
		if (!in_array($type, array('totoroPic'))) {
			return false;
		}
		if ($type && intval($typeid)) {
			$record = $this->find('typeid=:typeid AND type=:type', array(':typeid'=>$typeid, ':type'=>$type));
			if ($record) {
				$record->saveCounters(array('times'=>1));				
			}else{
				$likedata['type'] = $type;
				$likedata['typeid'] = intval($typeid);
				$likedata['times'] = '1';
				$this->attributes = $likedata;
				$this->save();
			}
			return true;

		}else{
			return false;
		}
	}
	
	public function getLike($type, $typeid){
		if ($type && intval($typeid)) {
			$record = $this->find('typeid=:typeid AND type=:type', array(':typeid'=>$typeid, ':type'=>$type));
			if ($record) {
				return $record['times'];
			}			
		}
		return false;
	}
}