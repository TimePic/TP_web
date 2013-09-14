<?php

/**
 * This is the model class for table "{{totorotalk_category}}".
 *
 * The followings are the available columns in table '{{totorotalk_category}}':
 * @property integer $catid
 * @property integer $upid
 * @property string $catname
 */
class TotorotalkCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TotorotalkCategory the static model class
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
		return '{{totorotalk_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('upid, catname', 'required'),
			array('upid', 'numerical', 'integerOnly'=>true),
			array('catname', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('catid, upid, catname', 'safe', 'on'=>'search'),
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
			'catid' => '分类ID',
			'upid' => '所属分类',
			'catname' => '分类名称',
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

		$criteria->compare('catid',$this->catid);
		$criteria->compare('upid',$this->upid);
		$criteria->compare('catname',$this->catname,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function updateCache(){
		$data = Yii::app()->db->createCommand()->select('*')->from('{{totorotalk_category}}')->queryAll();
		$category = array(0 => array(
						'catid' => '0',
						'upid' => '0',
						'catname' => '默认',
					)
			);
		foreach($data as $key => $row){
			$category[$row['catid']] = $row;
		}
		Yii::app()->cache->set('totoroTalkCategory', $category, 3600);
		
		return $category;
	}
	
	public function getTotoroCategory($catid){
		if ($catid) {
			if($category=Yii::app()->cache->get('totoroTalkCategory')){
			}else{
				$category = TotorotalkCategory::updateCache();
			}
			return $category[$catid]['catname'];
		}
		return "默认";
	}
	
	public function getTotoroCategorys(){

			if($category=Yii::app()->cache->get('totoroTalkCategory')){
			}else{
				$category = TotorotalkCategory::updateCache();
			}
			foreach($category as $catid=> $cat){
				$data[$catid] = $cat['catname'];
			}
			return $data;
	}
}