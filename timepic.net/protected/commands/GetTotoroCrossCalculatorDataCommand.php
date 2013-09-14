<?php
/*
 * [Willlee] (C)2001-2099 oss.xiaomi.com Inc.
 * This is NOT a freeware, use is subject to license terms

 */

/**
 * Description of ClearCacheCommand
 *
 * @author Will Lee<lishuzu@gmail.com> 2012-4-20 19:15:07
 */

class GetTotoroCrossCalculatorDataCommand extends CConsoleCommand{
	public function getHelp() {
		parent::getHelp();
		return "get some data";
	}
	
	public function run($args) {
		parent::run($args);
	}
	
	public function actionIndex($type = "shell"){
		//设置不超时
		set_time_limit(0);
		Yii::app()->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		$query = Yii::app()->db->createCommand()->select("*")->from("{{totoro_cross_combination}}")->where('status !=1')->query();
		while($row = $query->read()){
			$params = unserialize($row['formdata']);
			$kits = $this->fetchData($params);
			if($kits){
				foreach($kits as $kid){
					if($kid){
						$insert['formid'] = $row['formid'];
						$insert['imageid'] = $kid['id'];
						$insert['color'] = $kid['color'];
						$insert['probalility'] = str_replace("%", "", $kid['probability']);
						Yii::app()->db->createCommand()->insert("{{totoro_cross_color_data}}",$insert);
						Yii::app()->db->createCommand()->update("{{totoro_cross_combination}}", array('status'=>'1'), 'formid=:formid', array(':formid'=>$row['formid']));
						echo "[".$row['formid']."]".implode(',', $kid)."\n";
					}
				}
			}
		}
// 		$this->getData();
// 		$this->formData();
		echo "Data is done!!\n";
		Yii::app()->end();
	}
	
	//得到表单所有排列组合 入数据库
	public function actionGetFormData(){
// 		form 数据 demo
/* 		$parmas['DamGVC'] = 600000;
		$parmas['DamGene_id1'] = 0;
		$parmas['DamGene_id2'] = 0;
		$parmas['DamGene_id3'] = 0;
		$parmas['DamGene_id4'] = 0;
		$parmas['DamGene_id5'] = 6;
		$parmas['SireGVC'] = 601100;
		$parmas['SireGene_id1'] = 0;
		$parmas['SireGene_id2'] = 1;
		$parmas['SireGene_id3'] = 1;
		$parmas['SireGene_id4'] = 0;
		$parmas['SireGene_id5'] = 6;
		$parmas['SubmissionMode'] = 'GDVs'; */
		
		
		$GenotypeValueCode = 0;
		$posts = array();
		$params = array(
				'DamGene_id' => array(
							'1' => array(0,1,2),
							'2' => array(0,1),
							'3' => array(0,1),
							'4' => array(0,1,2, 3, 4),
							'5' => array(6,3, 1, 5, 4),
						),
				'SireGene_id' => array(
							'1' => array(0, 1, 2),
							'2' => array(0, 1),
							'3' => array(0, 1),
							'4' => array(0, 1, 2, 3, 4),
							'5' => array(6, 3, 1, 5, 4),
						),
				);
		//组合计数器 共有多少种组合
		$i = 0;
		$postdata = array();
		//dam start
		foreach($params['DamGene_id']['1'] as $d1){
			foreach($params['DamGene_id']['2'] as $d2){
				foreach($params['DamGene_id']['3'] as $d3){
					foreach($params['DamGene_id']['4'] as $d4){
						foreach($params['DamGene_id']['5'] as $d5){
							$data = array('1' => $d1, '2' => $d2, '3' => $d3, '4' => $d4, '5' => $d5);
							$GenotypeValueCode = 0;
							$postdata = array();
							$postdata['Dam']['code'] = '';
							foreach($data as $dk=>$dv){
								$postdata['Dam']['DamGene_id'.$dk] = $dv;
								$GenotypeValueCode += pow(10, $dk)*$dv;
								$postdata['Dam']['code'] .= $dv;
							}
							$postdata['Dam']['DamGVC'] = $GenotypeValueCode;

//  							echo implode(',', $postdata)."\n";
							//sire start
							foreach($params['SireGene_id']['1'] as $s1){
								foreach($params['SireGene_id']['2'] as $s2){
									foreach($params['SireGene_id']['3'] as $s3){
										foreach($params['SireGene_id']['4'] as $s4){
											foreach($params['SireGene_id']['5'] as $s5){
												$data = array('1' => $s1, '2' => $s2, '3' => $s3, '4' => $s4, '5' => $s5);
												$GenotypeValueCode = 0;
												$postdata['Sire']['code'] = '';
												foreach($data as $sk=>$sv){
													$postdata['Sire']['SireGene_id'.$sk] = $sv;
													$GenotypeValueCode += pow(10, $sk)*$sv;
													$postdata['Sire']['code'] .= $sv;
												}
												$postdata['Sire']['SireGVC'] = $GenotypeValueCode;
												$posts[$i] = $postdata;
												$i++;
// 												echo implode(',', $postdata[$i])."\n";
											}
										}
									}
								}
							}
							
							//sire end
						}
					}
				}
			}			
		}
		//dam end
		//格式化数据 插入数据库
		foreach ($posts as $key=>$value){
			$code = $value['Dam']['code'].$value['Sire']['code'];
			unset($value['Dam']['code']);
			unset($value['Sire']['code']);
			$formdata = array_merge($value['Dam'], $value['Sire']);
			$formdata['SubmissionMode'] = 'GDVs';
			$insert['formid'] = $code;
			$insert['formdata'] = serialize($formdata);
			Yii::app()->db->createCommand()->insert("{{totoro_cross_combination}}", $insert);
			echo "[".$code."]-($key)-".implode(',', $formdata)."\n";
		}
		Yii::app()->end();
	}
	
	//fetchImage
	public function actionFetchImage(){
		$url = "http://www.silverfallchinchilla.com/genetics/GenotypeImage.aspx?";
		$path = Yii::app()->getBasePath().'/../images/static/totorocross/';
		Yii::app()->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		$query = Yii::app()->db->createCommand()->select("imageid")->from("{{totoro_cross_color_data}}")->group('imageid')->query();
		while($row = $query->read()){
			$fetchurl = $url.$row['imageid'];
// 			$img = file_get_contents($fetchurl);
	        $ch = curl_init();
	        $user_agent = "Googlebot/2.1 (+http://www.googlebot.com/bot.html)";//这里模拟的是百度蜘蛛     
	        curl_setopt($ch, CURLOPT_URL, $fetchurl);
	        curl_setopt($ch, CURLOPT_HEADER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_REFERER, 'http://www.googlebot.com/bot.html');//这里写一个来源地址，可以写要抓的页面的首页     
	        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	        $img=curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if($httpcode == 200 && $img){
				$file = $path.$row['imageid'].".jpg";
				file_put_contents($file, $img);
				echo $fetchurl."[OK!!!]\n";
			}else{
				echo $fetchurl."[fail!!!]\n";
			}
		}
		echo "All Image is done!!!\n";
		Yii::app()->end();
	}
	
	private function fetchData($params){

		if (empty($params)){
			return false;
		}
		Yii::import('application.helpers.*');
		require_once('SimpleHtmlDom.php');
		$argument = $html_str = $httpcode = '';
		
// 		$parmas['DamGVC'] = 600000;
// 		$parmas['DamGene_id1'] = 0;
// 		$parmas['DamGene_id2'] = 0;
// 		$parmas['DamGene_id3'] = 0;
// 		$parmas['DamGene_id4'] = 0;
// 		$parmas['DamGene_id5'] = 6;
// 		$parmas['SireGVC'] = 601100;
// 		$parmas['SireGene_id1'] = 0;
// 		$parmas['SireGene_id2'] = 1;
// 		$parmas['SireGene_id3'] = 1;
// 		$parmas['SireGene_id4'] = 0;
// 		$parmas['SireGene_id5'] = 6;
// 		$parmas['SubmissionMode'] = 'GDVs';
		
		
		$kits = array();
		$site = "http://www.silverfallchinchilla.com/genetics/ChinCrossCalculator.aspx";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $site);
		foreach($params as $key=>$value){
			$argument .="$key=$value&";
		}
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $argument . "1=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, '60');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_REFERER, 'http://www.googlebot.com/bot.html');//这里写一个来源地址，可以写要抓的页面的首页     
		curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.googlebot.com/bot.html)');
		$html_str = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode && $html_str){
			$html = str_get_html($html_str);
			//			$kitshtml = $html->find('table th[colspan=4]', 0)->parent()->next_sibling()->find('td');
			$html->find('table th[colspan=4]', 0)->parent()->outertext = '';
			$tableHtml = $html->find('table th[colspan=4]', 0)->parent()->parent()->outertext;
			$tableHtml = str_get_html($tableHtml);
			foreach($tableHtml->find("td") as $kithtml){
				$id = $kithtml->first_child()->first_child()->src;
				$kit['id'] = trim(str_replace('GenotypeImage.aspx?', '', $id));
				$kit['color'] = trim($kithtml->first_child()->last_child()->plaintext);
				$kithtml->first_child()->outertext = '';
				$kit['probability'] = trim($kithtml->innertext);
				$kits[] = $kit;
			}
			return $kits;
		}else{
			return false;
		}

	}
	
}

?>
