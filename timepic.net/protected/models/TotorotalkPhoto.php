<?php

/**
 * This is the model class for table "{{totorotalk_photo}}".
 *
 * The followings are the available columns in table '{{totorotalk_photo}}':
 * @property integer $pid
 * @property string $ip
 * @property string $title
 * @property string $imgtype
 * @property integer $size
 * @property integer $thumb
 * @property string $filepath
 * @property string $filename
 * @property integer $dateline
 */
class TotorotalkPhoto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TotorotalkPhoto the static model class
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
		return '{{totorotalk_photo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('ip, title, imgtype, size, thumb, filepath, filename, dateline', 'required'),
			array('size, thumb, dateline', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>20),
			array('title, filepath', 'length', 'max'=>255),
			array('imgtype', 'length', 'max'=>40),
			array('filename', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pid, ip, title, imgtype, size, thumb, filepath, filename, dateline', 'safe', 'on'=>'search'),
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
			'pid' => 'Pid',
			'ip' => 'Ip',
			'title' => '标题',
			'imgtype' => '类型',
			'size' => '大小',
			'thumb' => '是否缩略图',
			'filepath' => '图片路径',
			'filename' => '图片名称',
			'dateline' => '创建时间',
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

		$criteria->compare('pid',$this->pid);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('imgtype',$this->imgtype,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('thumb',$this->thumb);
		$criteria->compare('filepath',$this->filepath,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('dateline',$this->dateline);
		//时间倒序
		$criteria->order = "dateline DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
	public function scopes() {
		parent::scopes();
        return array(
            'published'=>array(
                'order'=>'dateline DESC',
                'limit'=>5,
            ),
        );
	}
    //上传
    public function upload($photo, $thumb = '0' ,$watermark = '0'){
        $watermask_key = 'timepic719';
        $filename = date('His').strtolower(CommonHelper::random(16)).'.jpg';
        $filepath = CommonHelper::makepath().$filename;
        $uploadPath = CommonHelper::makepath(Yii::getPathOfAlias('webroot') . '/images/upload/totorotalk/');
		Yii::import('application.helpers.ImageWorkshop');
		require_once('ImageWorkshop.php');
		
        if (!file_exists($uploadPath)) {
            Time_FileHelper::forcemkdir($uploadPath);
        }
        //存储图片
        if ($photo['filepath']) {
			
			$layer = new ImageWorkshop(array(
						"imageFromPath" => $photo['filepath'],
					));
			$pathInfo = pathinfo($image);
			$layer->save($uploadPath.'/', $filename, true, '', 100);
            $photo['filename'] = $filename;
            $photo['filepath'] = $filepath;
			
        }
        if ($thumb > 0) {
			$this->resize($uploadPath.$filename);
            $photo['thumb'] = '1';
        }
		
		if ($watermark) {
			//缩略图 不打水印
			$watermarkfile = Yii::getPathOfAlias('webroot').'/images/static/common/watermark/480.png';
			$photoPath = $uploadPath.'thumb_'.$filename;
			$this->waterMark($photoPath, $watermarkfile, FALSE);
			
			$watermarkfile = Yii::getPathOfAlias('webroot').'/images/static/common/watermark/480.png';
			$photoPath = $uploadPath.'normal_'.$filename;
			$this->waterMark($photoPath, $watermarkfile);
		}
        $this->attributes = $photo;
        if ($this->save(true)) {
            return true;
        }
        return false;
    }
	
	public function resize($image){

		if (!file_exists($image)) {
			return false;
		}
		
		Yii::import('application.helpers.ImageWorkshop');
		require_once('ImageWorkshop.php');
        $thumbType = array(
            'thumb'=>array('width'=>'100','height'=>'150'),
            'normal'=>array('width'=>'320','height'=>'480'),
            'big'=>array('width'=>'640','height'=>'960'),
        );
		$backgroundColor = "000000";
		foreach ($thumbType as $type=>$value) {
			//缩略图
			$width = $value['width'];
			$height = $value['height'];

			$layer = new ImageWorkshop(array(
						"imageFromPath" => $image,
					));

			$layer->resizeInPixel($width, $height, true, 0, 0, 'MM');

			$pathInfo = pathinfo($image);
			$layer->save($pathInfo['dirname'].'/', $type.'_'.$pathInfo['basename'], true, $backgroundColor, 100);
		}
		return true;
	}
	
/**
 * image 需要增加水印的图片地址
 * watermark 水印路径
 * 是否增加水印 默认增加
 *
 * 
 * @property string $image
 * @property string $watermark
 * @property boolean $addwater
 */
	//生成水印
	public function waterMark($image, $watermark = '', $addwater=true){
		/*this is very importent,do not remove it*/
		$waterMarkKey = 'timepic719';
		
		Yii::import('application.helpers.ImageWorkshop');
		require_once('ImageWorkshop.php');
		if (file_exists($image)) {
			$photopath = $image;
			$waterpath = $watermark;

			$photo = new ImageWorkshop(array(
				"imageFromPath" => $photopath,
			));
			$watermarkLayer = new ImageWorkshop(array(
				"imageFromPath" => $waterpath,
			));
			$photoPathInfo = pathinfo($photopath);
			$savepath = $photoPathInfo['dirname'].'/mark/';
			$savefile = md5($photoPathInfo['basename'].$waterMarkKey).'.'.$photoPathInfo['extension'];

			if ($addwater) {
				$positionY = intval($photo->getHeight() / 3) - 10;
				$photo->addLayerOnTop($watermarkLayer, 12, $positionY, "RB");
			}

			
			$photo->save($savepath, $savefile, true);
			return true;
		}
		return false;
	}
}