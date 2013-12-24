<?php

/**
 * This is the model class for table "{{ieltseye_weibo}}".
 *
 * The followings are the available columns in table '{{ieltseye_weibo}}':
 * @property string $eid
 * @property string $uid
 * @property string $uidstr
 * @property string $screen_name
 * @property string $wbid
 * @property string $wbmid
 * @property string $text
 * @property integer $created_at
 * @property string $keywords
 * @property integer $dateline
 * @property integer $status
 * @property integer $source
 */
class IeltseyeWeibo extends CActiveRecord
{
    public $statusCode = array('-1'=>'隐藏', '0'=>'未发送微博', '1'=>'已发送微博', '2'=>'微博发送失败');
    public $sourceCode = array('0'=>'搜索', '1'=>'@我', '2'=>'名人微博');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IeltseyeWeibo the static model class
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
		return '{{ieltseye_weibo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, uidstr, screen_name, wbid, wbmid, text, created_at, dateline, status, source', 'required'),
			array('created_at, dateline, status, source', 'numerical', 'integerOnly'=>true),
			array('uid, uidstr, wbid, wbmid', 'length', 'max'=>255),
			array('screen_name, keywords', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eid, uid, uidstr, screen_name, wbid, wbmid, text, created_at, keywords, dateline, status, source', 'safe', 'on'=>'search'),
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
			'eid' => 'Eid',
			'uid' => 'Uid',
			'uidstr' => 'Uidstr',
			'screen_name' => 'Screen Name',
			'wbid' => 'Wbid',
			'wbmid' => 'Wbmid',
			'text' => 'Text',
			'created_at' => '微博发送时间',
			'keywords' => '搜索关键字',
			'dateline' => '采集时间',
			'status' => '状态',
			'source' => '来源',
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

		$criteria->compare('eid',$this->eid,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('uidstr',$this->uidstr,true);
		$criteria->compare('screen_name',$this->screen_name,true);
		$criteria->compare('wbid',$this->wbid,true);
		$criteria->compare('wbmid',$this->wbmid,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('status',$this->status);
		$criteria->compare('source',$this->source);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => array('created_at'=>'CSort::SORT_DESC'),
            )
		));
	}
    /*
     * get Weibo
     * keyword boolean  weather to get Weibo with keyword
     */
    public function getWeibo($keyword=''){
        $command = $countSql = '';
        //sql condition
        if (!empty($keyword)) {
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
        $data['keyword'] = $keyword;

//        $command = Yii::app()->db->createCommand();
//        $command->select('count(eid)');
//        $command->from('{{ieltseye_weibo}}');
//        //status -1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示
//        $command->where('status >=0');
//        
//        if (!empty($keyword)) {
//            $command->andwhere(array('like', 'text', '%'.$keyword.'%'));
//        }
//        
//        $countSql = $command->text;
        //Pagination
        $criteria = new CDbCriteria();
        //最大100页
		$pages=new CPagination(2000);
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
        $data['pages'] = $pages;
        
        //cache
        $countSql = "SELECT COUNT(*) FROM {{ieltseye_weibo}}";
        $dependency = new CDbCacheDependency($countSql);
 
        $command = Yii::app()->db->cache(3600, $dependency)->createCommand();
        
        $command->select('*');
        $command->from('{{ieltseye_weibo}}');
        //status -1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示
        $command->where('status >= 0');
        
        if (!empty($keyword)) {
            $command->andwhere(array('like', 'text', '%'.$keyword.'%'));
        }
        $command->order('created_at DESC');
        $command->limit($pages->pageSize, $pages->currentPage*$pages->pageSize);

		$query = $command->queryAll();
		foreach($query as $row){
            //去掉@某人
            $row['text'] = preg_replace("/@[\\x{4e00}-\\x{9fa5}\\w\\-]+/u", "", $row['text']);
            if (!empty($keyword)) {
                $row['text'] = str_ireplace($keyword, '<span class="alert alert-info ieltsKeyword">'.$keyword.'</span>', CHtml::encode($row['text']));   
            }
			$data['weibos'][] = $row;
		}
        return $data;
    }
    
    static function getApiWeibo($params=array(), $start=0, $length=20){
	if (isset($params['keyword'])) {
	    $keyword = $params['keyword'];
	    $keyword = strtr($keyword, array('%' => '\%', '_' => '\_'));
	}
	$data = array();

	//cache
	$dependency = new CDbCacheDependency('SELECT COUNT(*) FROM {{ieltseye_weibo}}');
	$command = Yii::app()->db->cache(3600, $dependency)->createCommand();

	$command->select('uid, screen_name, text, created_at');
	$command->from('{{ieltseye_weibo}}');

	//status -1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示
	$command->where('status >= 0');

	$command->order('created_at DESC');
	$command->limit($length, $start);

	if (!empty($keyword)) {
	    $command->where(array('like', 'text', '%' . $keyword . '%'));
	}

	$query = $command->queryAll();
	foreach ($query as $row) {
	    //去掉@某人
	    $row['text'] = preg_replace("/@[\\x{4e00}-\\x{9fa5}\\w\\-]+/u", "", $row['text']);
	    $row['created_at'] = CommonHelper::sgmdate('Y-m-d H:i:s', CHtml::encode($row['created_at']), 1);
	    $data[] = $row;
	}
	return $data;
    }
}