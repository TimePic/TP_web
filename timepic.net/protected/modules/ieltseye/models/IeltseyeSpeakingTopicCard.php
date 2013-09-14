<?php

/**
 * This is the model class for table "{{ieltseye_speaking_topic_card}}".
 *
 * The followings are the available columns in table '{{ieltseye_speaking_topic_card}}':
 * @property integer $cardid
 * @property string $question
 * @property string $questions
 * @property string $description
 * @property integer $type
 * @property string $tags
 * @property integer $dateline
 */
class IeltseyeSpeakingTopicCard extends CActiveRecord
{
    public $questions;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IeltseyeSpeakingTopicCard the static model class
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
		return '{{ieltseye_speaking_topic_card}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, type, description', 'required', 'on'=>'part2'),
			array('type, dateline', 'numerical', 'integerOnly'=>true),
            array('question', 'unique'),
            array('questions', 'questionsUnique', 'on'=>'Part13'),
            array('type', 'in', 'range'=>array(1,2,3,)),
			array('question, tags', 'length', 'max'=>255),
            array('description', 'length', 'max'=>6000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cardid, question, description, type, tags, dateline', 'safe', 'on'=>'search'),
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
            'topicSamples'=>array(self::HAS_MANY, 'IeltseyeSpeakingTopicCard', 'cardid'),
            'tagItem'=>array(self::HAS_MANY, 'IeltseyeTagitem', array('itemid'=>'cardid'), 'together'=>true),
            'IeltseyeSpeakingTopicCardCount'=>array(self::STAT, 'IeltseyeSpeakingTopicSample', 'cardid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cardid' => 'Cardid',
			'question' => 'Question',
            'questions' => 'Questions',
			'description' => 'Descripiton',
			'type' => 'Part',
            'tags' => 'Tags',
			'dateline' => 'Dateline',
            'IeltseyeSpeakingTopicCardCount' => 'Samples',
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

		$criteria->compare('cardid',$this->cardid);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type);
        $criteria->compare('tags',$this->tags,true);
		$criteria->compare('dateline',$this->dateline);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => array('dateline'=>'CSort::SORT_DESC'),
            )
		));
	}
    //多个question一起提交
    public function questionsUnique($attribute,$params){
        $isEmpty = true;
        if (!$this->hasErrors()) {
            if (!empty($this->questions)) {
                foreach ($this->questions as $key=>$question) {
                    if (!empty($question)) {
                        $res = $this->exists('question=:question', array(":question" => $question));
                        if ($res) {
                            $this->addError('questions', 'question'.($key+1).":".$question . ' 已经存在');
                        }
                        $isEmpty = false;
                    }
                }
                if ($isEmpty) {
                    $this->addError('questions', 'question:至少填写一个问题');
                }
            }
        }
    }
    
	public function beforeSave(){
        //all tags must be lowercase due to search factor.
        $this->tags = strtolower($this->tags);
        //set tagstr for card
        if ($this->tags) {
            $this->setTags();
        }
		if ($this->isNewRecord) {
            $this->dateline = time();
        }
		return true;
	}
    
    public function afterSave() {
        if ($this->isNewRecord) {
            $this->setTagItems($this->tags);
        }
    }
    public function setTagItems($tags){
        $tagcount = 0;
        if ($tags) {
            $tagarray_all = explode(';', $tags);
            if($tagarray_all) {
                foreach($tagarray_all as $var) {
                    if($var) {
                        $arrtemp = explode(',', $var);
                        $threadtag_array[$arrtemp[0]] = $arrtemp[1];
                    }
                }
            }
            foreach($threadtag_array as $tagid=>$tagname){
                $tagItem = new IeltseyeTagitem();
                $tagItem->tagname = $tagname;
                $tagItem->tagid = $tagid;
                $tagItem->itemid = $this->cardid;
                $tagItem->idtype = 'cardid';
                $tagItem->save();
                
                $tagcount++;
                if($tagcount > 4) {
                    unset($threadtag_array);
                    break;
                }
            }
            return true;
        }
        return FALSE;        
    }
    
    public function setTags(){
        $tagstr = '';
        $tags = $this->tags;
        //process tags
        if ($tags) {
            $tags = str_replace(array(chr(0xa3).chr(0xac), chr(0xa1).chr(0x41), chr(0xef).chr(0xbc).chr(0x8c)), ',', $tags);
            if(strpos($tags, ',') !== FALSE) {
                $tagarray = array_unique(explode(',', $tags));
            } else {
                $tags = str_replace('　', ' ', $tags);
                $tagarray = array_unique(explode(' ', $tags));
            }
        }
        $tagcount = 0;
//        create
        if ($this->isNewRecord) {
            foreach($tagarray as $tagname) {
                $tagname = trim($tagname);
                if(preg_match('/^([\x7f-\xff_-]|\w|\s){3,20}$/', $tagname)) {
                    $result = IeltseyeTag::model()->find('tagname=:tagname', array(':tagname'=>$tagname));
                    if(isset($result->tagid)) {
                        $tagid = $result->tagid;
                    } else {
                        $tagModel = new IeltseyeTag();
                        $tagModel->tagname = $tagname;
                        $tagModel->save();
                        $tagid = $tagModel->tagid;
                        unset($tagModel);
                    }
                    if($tagid) {
                        $tagstr .= $tagid.','.$tagname.';';
                    }
                    $tagcount++;
                    if($tagcount > 4) {
                        unset($tagarray);
                        break;
                    }
                }
            }
            $this->tags = $tagstr;
            return true;
        //update
        }else{
            $tagstr = $this->findByPk($this->cardid)->tags;
            $cardtagarray = $cardtagidarray = $cardtagarraynew = array();
            $datas = IeltseyeTagitem::model()->findAll('idtype=:idtype AND itemid=:itemid', array(':idtype'=>'cardid', ':itemid'=>$this->cardid));
            foreach($datas as $key=>$item){
                $cardtagarray[] = $item->tagname;
                $cardtagidarray[] = $item->tagid;
            }
            //tagarray 为空 则是删除tag 不增加任何新标签
            if(!empty($tagarray)){
                foreach($tagarray as $tagname) {
                    $tagname = trim($tagname);
                    if(preg_match('/^([\x7f-\xff_-]|\w|\s){3,20}$/', $tagname)) {
                        //复制当前标签到数组
                        $cardtagarraynew[] = $tagname;
                        //生成原来没有的标签
                        if (!in_array($tagname, $cardtagarray)) {
                            $result = IeltseyeTag::model()->find('tagname=:tagname', array(':tagname'=>$tagname));
                            if(isset($result->tagid)) {
                                $tagid = $result->tagid;
                            } else {
                                $tagModel = new IeltseyeTag();
                                $tagModel->tagname = $tagname;
                                $tagModel->save();
                                $tagid = $tagModel->tagid;
                                unset($tagModel);
                            }
                            if($tagid) {
                                $tagItem = new IeltseyeTagitem();
                                $tagItem->tagname = $tagname;
                                $tagItem->tagid = $tagid;
                                $tagItem->itemid = $this->cardid;
                                $tagItem->idtype = 'cardid';
                                $tagItem->save();
                                $tagstr .= $tagid.','.$tagname.';';
                            }
                        }
                        $tagcount++;
                        if($tagcount > 4) {
                            unset($tagarray);
                            break;
                        }
                    }
                }
            }
            //原有标签和新标签比较，删除新标签没有的元素
            foreach ($cardtagarray as $key => $tagname) {
                if(!in_array($tagname, $cardtagarraynew)) {
                    IeltseyeTagitem::model()->deleteAll('idtype=:idtype AND itemid=:itemid AND tagname=:tagname', array(':idtype'=>'cardid', ':itemid'=>$this->cardid, ':tagname'=>$tagname));
                    $tagid = $cardtagidarray[$key];
                    $tagstr = str_replace($tagid.",".$tagname.';', '', $tagstr);
                }
            }
            //没有任何新标签则为删除所有标签
            if (empty($tagarray)) {
                $tagstr = '';
            }
            $this->tags = $tagstr;
            return $tagstr;
        }
    }
    
    public function getPartByTag($tag){
        $data = array();
        if (is_numeric($tag)) {
            $tagid = intval($tag);
        }elseif (!empty ($tag)) {
            $tagname = $tag;
        }else{
            return FALSE;
        }
        
        if ($tagid) {
            $tag = IeltseyeTag::model()->findByPk($tagid);
        }else{
            $tag = IeltseyeTag::model()->find('tagname=:tagname', array(':tagname'=>$tagname));
        }
        
        if ($tag->tagid) {
            $count = Yii::app()->db->createCommand()->select('count(*)')->from('{{ieltseye_tagitem}}')->where('tagid=:tagid AND idtype=:idtype', array(':tagid'=>$tag->tagid, ':idtype'=>'cardid'))->queryScalar();
            $query = Yii::app()->db->createCommand()->select('*')->from('{{ieltseye_tagitem}}')->where('tagid=:tagid AND idtype=:idtype', array(':tagid'=>$tag->tagid, ':idtype'=>'cardid'))->query();
            while($row = $query->read()){
                $cardids[] = $row['itemid'];
            }
            
            //cache
            $cardCacheSql = Yii::app()->db->createCommand()->select('count(*)')->from('{{ieltseye_speaking_topic_card}}')->where(array('in', 'cardid', $cardids))->text;
            $dependency = new CDbCacheDependency($cardCacheSql);
            $command = Yii::app()->db->cache(3600, $dependency)->createCommand()->select('*')->from('{{ieltseye_speaking_topic_card}}')->where(array('in', 'cardid', $cardids));
            $dataProvider = new CSqlDataProvider($command, array(
                    'totalItemCount'=>$count,
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                    'sort' => array(
                        'defaultOrder' => array('dateline' => 'CSort::SORT_DESC'),
                    ),
                )
            );
            $data['dataProvider'] = $dataProvider;
            $data['tagname'] = $tag->tagname;
            return $data;
        }
        
    }

    public function getPart($part, $keyword =''){
//        part
        $part = intval($part);
        if (!in_array($part, array(1,2,3))) {
            $part = 2;
        }
//        keyword
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
        
        $command = Yii::app()->db->createCommand();
        $command->select('count(cardid)');
        $command->from('{{ieltseye_speaking_topic_card}}');
        if (!empty($keyword)) {
            $command->where(array('like', 'question', '%'.$keyword.'%'));
        }
        if ($part) {
            $command->andWhere('type=:type', array(':type'=>$part));
        }
        $count = $command->queryScalar();
        
        $command = Yii::app()->db->createCommand();
        $command->select('*');
        $command->from('{{ieltseye_speaking_topic_card}}');
        if (!empty($keyword)) {
            $command->where(array('like', 'question', '%'.$keyword.'%'));
        }
        if ($part) {
            $command->andWhere('type=:type', array(':type'=>$part));
        }
        $command->order('dateline DESC');

        $dataProvider = new CSqlDataProvider($command, array(
                'totalItemCount'=>$count,
                'pagination' => array(
                    'pageSize' => 10,
                ),
                'sort' => array(
                    'defaultOrder' => array('dateline' => 'CSort::SORT_DESC'),
                ),
            )
        );
        
        return $dataProvider;
        
    }
}