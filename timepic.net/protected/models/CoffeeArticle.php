<?php

/**
 * This is the model class for table "{{coffee_article}}".
 *
 * The followings are the available columns in table '{{coffee_article}}':
 * @property integer $aid
 * @property string $title
 * @property string $content
 * @property integer $catid
 * @property integer $dateline
 * @property string $tag
 * @property string $source
 * @property integer $displayorder
* @property string $filepath
 */
class CoffeeArticle extends CActiveRecord
{
    public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CoffeeArticle the static model class
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
		return '{{coffee_article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, catid, source', 'required'),
			array('catid, dateline, displayorder', 'numerical', 'integerOnly'=>true),
			array('title, tag, source', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('aid, title, content, catid, dateline, tag, source, displayorder', 'safe', 'on'=>'search'),
            array('image', 'file', 'types'=>'jpeg, jpg, gif, png', 'allowEmpty'=> TRUE),
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
			'aid' => 'Aid',
			'title' => '标题',
			'content' => '内容',
			'catid' => '分类',
			'dateline' => '时间',
			'source' => '来源',
			'displayorder' => '显示顺序',
            'image' => '图片',
            'filepath' => '图片路径',
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
		$criteria->compare('catid',$this->catid);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('displayorder',$this->displayorder);
        //默认按照显示顺序排列
        if (!$_GET['ajax'] && !$_GET['CoffeeArticle_sort']) {
            $criteria->order = "displayorder DESC";
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
			if($this->isNewRecord){
				$this->dateline=time();                
            }else{
                $this->dateline=time();
            }
			return true;
		}else{
			return false;            
        }

	}
	
	public function getCategorys(){
		$category = Yii::app()->params['coffee_category'];
		foreach($category as $catid=> $cat){
			$data[$catid] = $cat['catname'];
		}
		return $data;
	}
	
	public function getCategoryById($catid){
		if ($catid) {
			$category = Yii::app()->params['coffee_category'];
			$catname = $category[$catid]['catname'] ? $category[$catid]['catname'] : '默认';
			return $catname;			
		}
		return false;

	}
    
}