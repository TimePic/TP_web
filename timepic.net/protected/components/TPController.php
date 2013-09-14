<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TPController
 *
 * @author lixiaoxin
 */
class TPController extends Controller
{
	
	public function init() {
		$this->checkLang();
		if (CommonHelper::checkmobile()) {
//			Yii::app()->theme = 'mobile';
		}

	}

	//检测语言
	public function checkLang(){
		$langs = array('en', 'zh_cn', 'kr');
		$lang = $serverlang = '';
		$serverlang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		if (isset ($serverlang[0])) {
			$serverlang =  strtolower(str_replace('-', '_', $serverlang[0]));			
		}else{
			$serverlang = '';
		}

		
		if (Yii::app()->request->getParam('lang')) {
			$lang = Yii::app()->request->getParam('lang');
		}elseif(Yii::app()->request->cookies['lang']->value){
			$lang = Yii::app()->request->cookies['lang']->value;
		}elseif($serverlang){
			$lang = $serverlang;
		}else{
			$lang = '';
		}

		if (!in_array($lang, $langs)) {
			$lang = 'zh_cn';
		}

		if (isset($lang) && $lang != "") {
			Yii::app()->language = $lang;
			$cookie=new CHttpCookie('lang',$lang);
			Yii::app()->request->cookies['lang']=$cookie;
		}
		
		Yii::app()->language = Yii::app()->request->cookies['lang']->value;
	}
	
}

?>
