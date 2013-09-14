<?php

/**
 * This is the model class for table "{{chinchilla_market_trade_pic}}".
 *
 * The followings are the available columns in table '{{chinchilla_market_trade_pic}}':
 * @property integer $picid
 * @property integer $uid
 * @property integer $tradeId
 * @property string $ip
 * @property string $filename
 * @property string $type
 * @property integer $size
 * @property string $filepath
 * @property integer $thumb
 * @property integer $status
 * @property integer $dateline
 */
class ChinchillaMarketTradePic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChinchillaMarketTradePic the static model class
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
		return '{{chinchilla_market_trade_pic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, tradeId, filename, type, size, filepath, thumb, status, dateline', 'required'),
			array('uid, tradeId, size, thumb, status, dateline', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>15),
			array('filename, filepath', 'length', 'max'=>255),
			array('type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('picid, uid, tradeId, ip, filename, type, size, filepath, thumb, status, dateline', 'safe', 'on'=>'search'),
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
			'picid' => 'Picid',
			'uid' => 'Uid',
			'tradeId' => 'Trade',
			'ip' => 'Ip',
			'filename' => 'Filename',
			'type' => 'Type',
			'size' => 'Size',
			'filepath' => 'Filepath',
			'thumb' => 'Thumb',
			'status' => 'Status',
			'dateline' => 'Dateline',
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

		$criteria->compare('picid',$this->picid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('tradeId',$this->tradeId);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('filepath',$this->filepath,true);
		$criteria->compare('thumb',$this->thumb);
		$criteria->compare('status',$this->status);
		$criteria->compare('dateline',$this->dateline);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function deletePic($id) {
        if (intval($id)) {
            $data = $this->findByPk($id);
            $data->delete();
            $image_origin = CommonHelper::getImageByType($data->filepath, 'chinchillaMarket' , "origin");
            $image_big = CommonHelper::getImageByType($data->filepath,'chinchillaMarket', "big");
            $image_normal = CommonHelper::getImageByType($data->filepath,'chinchillaMarket', "normal");
            $image_thumb = CommonHelper::getImageByType($data->filepath, 'chinchillaMarket', "thumb");
            
            $image_big_water = CommonHelper::getImageByType($data->filepath,'chinchillaMarket', "big", 'path', 1);
            $image_normal_water = CommonHelper::getImageByType($data->filepath,'chinchillaMarket', "normal", 'path', 1);
            $image_thumb_water = CommonHelper::getImageByType($data->filepath, 'chinchillaMarket', "thumb", 'path', 1);
            if (file_exists($image_origin)) {
                @unlink($image_origin);
                @unlink($image_normal);
                @unlink($image_big);
                @unlink($image_thumb);
                
                @unlink($image_big_water);
                @unlink($image_normal_water);
                @unlink($image_thumb_water);
                
            }
            
        }
    }
}