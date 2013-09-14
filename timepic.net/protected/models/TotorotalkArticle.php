<?php

/**
 * This is the model class for table "{{totorotalk_article}}".
 *
 * The followings are the available columns in table '{{totorotalk_article}}':
 * @property integer $aid
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $thumbimg
 * @property integer $dateline
 */
class TotorotalkArticle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TotorotalkArticle the static model class
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
		return '{{totorotalk_article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content', 'required'),
			array('image, thumbimg', 'length', 'max'=>'255'),
			array('dateline,displayorder,catid', 'numerical', 'integerOnly'=>true),
			array('title, image, thumbimg', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('aid, title, content, image, thumbimg, dateline,catid', 'safe', 'on'=>'search'),
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
			'aid' => 'ID',
			'title' => '标题',
			'content' => '内容',
			'image' => '图片',
			'thumbimg' => '缩略图',
			'views' => '浏览量',
			'dateline' => '创建时间',
			'displayorder' => '显示顺序',
			'catid' => '分类',
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

		$criteria->compare('aid',$this->aid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('thumbimg',$this->thumbimg,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('catid',$this->catid);
		//默认按照显示顺序排列
		if (!$_GET['ajax'] && !$_GET['CoffeeArticle_sort']) {
		    $criteria->order = "views DESC";
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave()
	{
		if (!$this->displayorder) {
			$this->displayorder = 0;
		}
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
				$this->dateline=time();
			return true;
		}
		else
			return false;
	}
}