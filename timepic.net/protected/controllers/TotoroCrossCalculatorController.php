<?php

class TotoroCrossCalculatorController extends TPController {

	public $pageTitle = 'TimePic-龙猫-后代-基因-毛色-计算器-龙猫后代毛色计算器-中文版-TotoroCrossCalculator-chinchilla-Cross-Calculator';

	public function actionIndex() {
		$formselect = array(
			'DamGene_id1' => array('0' => 'selected="selected"'),
			'DamGene_id2' => array('0' => 'selected="selected"'),
			'DamGene_id3' => array('0' => 'selected="selected"'),
			'DamGene_id4' => array('0' => 'selected="selected"'),
			'DamGene_id5' => array('6' => 'selected="selected"'),
			'SireGene_id1' => array('0' => 'selected="selected"'),
			'SireGene_id2' => array('0' => 'selected="selected"'),
			'SireGene_id3' => array('0' => 'selected="selected"'),
			'SireGene_id4' => array('0' => 'selected="selected"'),
			'SireGene_id5' => array('6' => 'selected="selected"'),
		);
		$translate = array(
			
			"Beige (Hetero)" => "米色",
			"Beige (Homo)" => "金色",
			"(Hetero Beige)" => "(米色)",
			"(Hetero  Beige)" => "(米色)",
			"(Homo Beige)" => "(金色)",
			"(Homo  Beige)" => "(金色)",
			"Mosaic" => "纯白",
			"Silver" => "银白",
			"Sapphire" => "蓝灰",
			"Violet" => "紫灰",
			"Carrier" => "基因",
			"Black" => "黑色",
			"Brown" => "咖啡",
			"Velvet" => "丝绒",
			"Vio-Sap" => "紫蓝灰",
			"Chocolate" => "深褐色",
			"Ebony" => "黑色",
			"White" => "白色",
			"Tan" => "咖啡",
			"TOV" => "丝绒",
			"Sap" => "蓝灰",
			"Homo Beige" => "金色",
			"Lethal" => "致命的",
			"Light" => "浅",
			"Medium" => "中",
			"MediTOV" => "中",
			"Extra" => "纯",
			"Dark" => "深",
			"Pink" => "粉",
			"Standard" => "标准",
			"Carr." => "基因",
			"Carr" => "基因",
			"Gray" => "灰",
			"Beige" => "米色",
			"Homo" => "类似",
			"Hetero" => "不同",
			"and" => "并且",
			"or" => "或",

		);
		if ($_POST) {
			$formid = '';
			$formselect = array();
			unset($_POST['SubmissionMode']);
			unset($_POST['DamGVC']);
			unset($_POST['SireGVC']);
			foreach ($_POST as $key => $value) {
				$formid .= intval($value);
				$formselect[$key][intval($value)] = 'selected="selected"';
			}
			if ($formid) {
				$query = Yii::app()->db->createCommand()->select('*')->from('{{totoro_cross_color_data}}')->where('formid=:formid', array(':formid' => $formid))->query();
				while ($row = $query->read()) {
					//只有语言选择中文才开始翻译。
					if (Yii::app()->language == 'zh_cn') {
						$row['color'] = str_replace(array_keys($translate), $translate, $row['color']);						
					}

					$row['probalility'] = $row['probalility'] . "%";
					$kits[] = $row;
				}
			}
		}
		$this->render('index', array('kits' => $kits, 'formselect' => $formselect));
	}

	//得到图片
	public function actionGetImage($id, $mode = '') {
                //屏蔽该方法
                Yii::app()->end();
		$id = intval($id);
		$url = Yii::app()->basePath . "/../images/static/totorocross/" . $id . ".jpg";

		if (!file_exists(Yii::app()->basePath . "/../images/static/totorocross/" . $id . ".jpg")) {
			$param = '';

			$mode = $mode ? "SHOWNAME" : '';
			if ($mode) {
				$param = "&Mode=$mode";
			}
			$url = "http://www.silverfallchinchilla.com/genetics/GenotypeImage.aspx?$id";
			//根据id来获取带名字的图片 默认都带名字
//			if ($type) {
//				$url = "http://www.silverfallchinchilla.com/genetics/GenotypeImage.aspx?$id";
//			}else{
//				$url = "http://www.silverfallchinchilla.com/genetics/GenotypeImage.aspx?GVC=$id".$param;
//			}
		}
		$img = file_get_contents($url);
		header('Content-Type: image/gif');
		echo $img;
		Yii::app()->end();
	}
 
	// Uncomment the following methods and override them if needed
	/*
	  public function filters()
	  {
	  // return the filter configuration for this controller, e.g.:
	  return array(
	  'inlineFilterName',
	  array(
	  'class'=>'path.to.FilterClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }

	  public function actions()
	  {
	  // return external action classes, e.g.:
	  return array(
	  'action1'=>'path.to.ActionClass',
	  'action2'=>array(
	  'class'=>'path.to.AnotherActionClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }
	 */
}
