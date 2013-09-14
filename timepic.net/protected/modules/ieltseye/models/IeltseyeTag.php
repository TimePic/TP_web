<?php

/**
 * This is the model class for table "{{ieltseye_tag}}".
 *
 * The followings are the available columns in table '{{ieltseye_tag}}':
 * @property integer $tagid
 * @property string $tagname
 * @property string $aliasWords
 * @property integer $status
 */
class IeltseyeTag extends CActiveRecord
{
    public $fromTagid;
    public $toTagid;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IeltseyeTag the static model class
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
		return '{{ieltseye_tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tagname', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('tagname', 'length', 'max'=>20),
			array('aliasWords', 'length', 'max'=>255),
            //merge action
            array('fromTagid, toTagid', 'numerical', 'integerOnly'=>true, 'on'=>'merge'),
            array('fromTagid, toTagid', 'required', 'on'=>'merge'),
            array('fromTagid, toTagid', 'exist', 'attributeName'=>'tagid', 'on'=>'merge', 'message'=>'tagid:{value}不存在,无法进行合并'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tagid, tagname, aliasWords, status', 'safe', 'on'=>'search'),
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
            'tagItems' => array(self::HAS_MANY, 'IeltseyeTagitem', 'tagid'),
            'IeltseyeTagitemCount'=>array(self::STAT, 'IeltseyeTagitem', 'tagid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tagid' => 'Tagid',
			'tagname' => 'Tagname',
			'aliasWords' => 'Alias Words',
			'status' => 'Status',
            //merge
            'fromTagid'=>'fromTagid',
            'toTagid'=>'toTagid',
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
        $criteria->together = true;
        $criteria->compare('tagid',$this->tagid);
		$criteria->compare('tagname',$this->tagname,true);
        $criteria->compare('aliasWords',$this->aliasWords,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
		));
	}
    
    public function beforeSave() {
        $this->checkAliasWords();
        return true;
    }
    
    public function checkAliasWords() {
        $alias = $aliasStr = '';
        if ($this->aliasWords) {
            $alias = str_replace(array(chr(0xa3) . chr(0xac), chr(0xa1) . chr(0x41), chr(0xef) . chr(0xbc) . chr(0x8c)), ',', $this->aliasWords);
            if (strpos($alias, ',') !== FALSE) {
                $aliasArray = array_unique(explode(',', $alias));
            } else {
                $alias = str_replace('　', ' ', $alias);
                $aliasArray = array_unique(explode(' ', $alias));
            }
            if ($aliasArray) {
                foreach($aliasArray as $aliasWord) {
                    $aliasWord = trim($aliasWord);
                    if(preg_match('/^([\x7f-\xff_-]|\w|\s){1,20}$/', $aliasWord)) {
                        $aliasStr[] = $aliasWord;
                    }
                }
            }
            $this->aliasWords = implode(',', $aliasStr);
            return true;
        }
        return false;
    }
    /*
     * $tagid
     * $action update delete
     */
    public function updateCard($tagid, $action="update"){
        $tagid = intval($tagid) ? intval($tagid) : 0;
        if ($tagid) {
            $tagItems = IeltseyeTagitem::model()->findAll('tagid=:tagid', array(':tagid'=>$tagid));
            if ($tagItems) {
                foreach ($tagItems as $tagItem) {
                    $tagstr = '';
                    $cardTagArray = array();
                    $card = IeltseyeSpeakingTopicCard::model()->findByPk($tagItem->itemid);
                    //delete
                    if ($action == 'delete') {
                        $tagstr = str_replace($tagItem->tagid.",".$tagItem->tagname.';', '', $card->tags);
                    }else{
                        //update
                        $tagarray_all = explode(';', $card->tags);
                        if($tagarray_all) {
                            foreach($tagarray_all as $var) {
                                if($var) {
                                    $array_temp = explode(',', $var);
                                    $cardTagArray[$array_temp['0']] = $array_temp['1'];
                                }
                            }
                        }
                        $cardTagArray[$tagItem->tagid] = $tagItem->tagname;
                        foreach($cardTagArray as $tagid=>$tagname){
                            $tagstr .= $tagid.','.$tagname.';';
                        }
                    }
                    Yii::app()->db->createCommand()->update('{{ieltseye_speaking_topic_card}}', array('tags'=>$tagstr), 'cardid=:cardid', array(':cardid'=>$tagItem->itemid));
                }
                return true;
            }
            
        }
        return false;
    }
    
    public function mergeTags($fromTagid, $toTagid){
        if (intval($fromTagid) && intval($toTagid)) {
            $toTag = IeltseyeTag::model()->findByPk($toTagid);
            $tagItems = IeltseyeTagitem::model()->findAll('tagid=:tagid', array(':tagid'=>$fromTagid));
            $cardidarray = array();
            foreach($tagItems as $fromtag){
                if($fromtag->idtype == 'cardid'){
                    $itemid = $fromtag->itemid;
                    $cardidarray[$itemid] = $cardidarray[$itemid] == '' ? 'tags' : $cardidarray[$itemid];
                    $cardidarray[$itemid] = "(REPLACE($cardidarray[$itemid], '$fromtag->tagid,$fromtag->tagname".';'."', ''))";
                    /*
                     * 当card 同时拥有源标签和目标标签时
                     * 需要删除源标签，保持目标标签
                     * 
                     * home标签 合并到 accomendation 标签中，有的card 同时带有两个标签。合并时 tagitem表将出现两条一样的关系。为了避免，需检测，如果目标标签已经存在。删除原有标签的关系，不存在则update一条。
                     */
                    $isexist = IeltseyeTagitem::model()->exists('tagid=:totagid AND itemid=:itemid AND idtype="cardid"', array(':totagid'=>$toTagid, 'itemid'=>$itemid));
                    if ($isexist) {
                        IeltseyeTagitem::model()->findByPk($fromtag->tid)->delete();
//                        echo "delelte:$fromtag->tid\r\n<br/>";
                    }
                }
            }
            Yii::app()->db->createCommand()->update('{{ieltseye_tagitem}}', array('tagid'=>$toTag->tagid, 'tagname'=>$toTag->tagname), 'tagid=:fromTagid', array(':fromTagid'=>$fromTagid));
            if($cardidarray) {
                foreach($cardidarray as $key => $var) {
                    $card = IeltseyeSpeakingTopicCard::model()->findByPk($key);
                    if($card){
                        //replace fromTag to null
                        Yii::app()->db->createCommand()->update('{{ieltseye_speaking_topic_card}}', array('tags'=>new CDbExpression($var)),'cardid=:cardid', array(':cardid'=>$card->cardid));
                        //to prevent duplacating, replace toTagid to null
                        Yii::app()->db->createCommand()->update('{{ieltseye_speaking_topic_card}}', array('tags'=> new CDbExpression("(REPLACE(tags, '$toTag->tagid,$toTag->tagname;', ''))")),'cardid=:cardid', array(':cardid'=>$card->cardid));
                        Yii::app()->db->createCommand()->update('{{ieltseye_speaking_topic_card}}', array('tags'=> new CDbExpression("concat(tags, '$toTag->tagid,$toTag->tagname;')")),'cardid=:cardid', array(':cardid'=>$card->cardid));
                    }

                }
            }
            return true;
        }
        return false;
    }
}