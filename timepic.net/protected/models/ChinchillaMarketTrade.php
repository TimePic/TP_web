<?php

/**
 * This is the model class for table "{{chinchilla_market_trade}}".
 *
 * The followings are the available columns in table '{{chinchilla_market_trade}}':
 * @property integer $tradeId
 * @property integer $uid
 * @property integer $breed
 * @property integer $gender
 * @property integer $birthday
 * @property integer $weight
 * @property integer $white
 * @property integer $black
 * @property integer $beige
 * @property integer $velvet
 * @property integer $violet
 * @property integer $sapphire
 * @property string $ip
 * @property string $contact
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property string $pic
 * @property integer $expiredDate
 * @property integer $mode
 * @property integer $dateline
 * @property integer $views
 * @property integer $displayorder
 */
class ChinchillaMarketTrade extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ChinchillaMarketTrade the static model class
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
		return '{{chinchilla_market_trade}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, breed, gender, birthday, weight, title, description, price, expiredDate', 'required'),
			array('uid, breed, gender, weight, white, black, beige, velvet, violet, sapphire, price, mode, dateline, displayorder', 'numerical', 'integerOnly'=>true),
			array('gender', 'in', 'range'=>array(0, 1)),
			array('birthday', 'date','format'=>'yyyy/mm/dd'),
			array('expiredDate', 'date','format'=>'yyyy/mm/dd'),
			array('weight', 'numerical', 'min'=>10, 'max'=>2000),
			array('ip', 'length', 'max'=>15),
			array('title', 'length', 'min'=>4, 'max'=>60),
            array('contact', 'length', 'min'=>0, 'max'=>60),
			array('description', 'length', 'min'=>4, 'max'=>2000),
			array('price', 'numerical', 'min'=>1, 'max'=>1000000),
			array('pic', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tradeId, uid, breed, gender, birthday, weight, white, black, beige, velvet, violet, sapphire, ip, title, description, price, pic, expiredDate, dateline, displayorder', 'safe', 'on'=>'search'),
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
            'author'=>array(self::BELONGS_TO, 'Member', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tradeId' => 'Trade',
			'uid' => 'Uid',
			'breed' => '品种/毛色',
			'gender' => '性别',
			'birthday' => '生日',
			'weight' => '体重',
			'white' => '白色', 
			'black' => '黑色',
			'beige' => '米色',
			'velvet' => '丝绒', 
			'violet' => '紫色', 
			'sapphire' => '蓝色', 
			'ip' => 'Ip',
            'contact' => '联系方式',
			'title' => '标题',
			'description' => '描述',
			'price' => '价格',
			'pic' => '封面',
			'expiredDate' => '过期时间',
            'mode' => '选择模式', //0经典模式 1高级模式
			'dateline' => '发表日期',
			'views' => '浏览次数',
			'displayorder' => 'Displayorder',
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

		$criteria->compare('tradeId',$this->tradeId);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('breed',$this->breed);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birthday',$this->birthday);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('white',$this->white);
		$criteria->compare('black',$this->black);
		$criteria->compare('beige',$this->beige);
		$criteria->compare('velvet',$this->velvet);
		$criteria->compare('violet',$this->violet);
		$criteria->compare('sapphire',$this->sapphire);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('expiredDate',$this->expiredDate);
		$criteria->compare('mode',$this->mode);
		$criteria->compare('dateline',$this->dateline);
		$criteria->compare('views',$this->views);
		$criteria->compare('displayorder',$this->displayorder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	//* format the data for this model e.g. dateline or uid
	public function beforeSave(){
		$this->birthday = strtotime($this->birthday);
		$this->expiredDate = strtotime($this->expiredDate);
		return true;
	}
    
    public function getChinchillaColor($colorCode){
        if ($colorCode) {
            $translate = Yii::app()->getParams('chinchilla')->chinchilla['colorTranslate'];
			$row = Yii::app()->db->createCommand()->select('*')->from('{{totoro_color}}')->where('imageid=:imageid', array(':imageid' => $colorCode))->query()->read();
			//只有语言选择中文才开始翻译。
			if (Yii::app()->language == 'zh_cn') {
				$row['color'] = str_replace(array_keys($translate), $translate, $row['color']);	
			}
			if (isset($row['color'])) {
				return $row['color'];
			}
        }
        return FALSE;
    }
    /**
     *  white        白色 0无 1有
     *  black        黑色 0无 1浅 2中 3深 4纯
     *  beige        0无 1 米色 2金色
     *  velvet       丝绒 0 无 1有
     *  violet       紫色 0 无 3紫灰 5带紫灰基因
     *  sapphire     蓝色 0 无 1蓝灰 4带蓝灰基因
     * @param type $color 600000 六位数字
     */
    public function checkColor($color){
        $colors = array();
        if ($color) {
            for($i=0;$i<6;$i++){
                switch ($i) {
                    case 0:
                        if ($color[$i] == 6) {
                            $colors['sapphire'] = $colors['violet'] = '0';
                        }elseif($color[$i] == 3 || $color[$i] == 5){
                            $colors['violet'] = $color[$i];
                            $colors['sapphire'] = '0';
                        }elseif($color[$i] == 1 || $color[$i] == 4){
                            $colors['sapphire'] = $color[$i];
                            $colors['violet'] = '0';   
                        }
                        break;
                    case 1:
                        $colors['black'] = $color[$i];
                        break;
                    case 2:
                        $colors['velvet'] = $color[$i];
                        break;
                    case 3:
                        $colors['white'] = $color[$i];
                        break;
                    case 4:
                        $colors['beige'] = $color[$i];
                        break;
                    case 6:
                        break;
                    default:
                        break;
                }
            }  
            return $colors;
        }
        return false;
    }
}