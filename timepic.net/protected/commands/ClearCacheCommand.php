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

class ClearCacheCommand extends CConsoleCommand{
	public function getHelp() {
		parent::getHelp();
		return "默认清除assets 和runtime下所有文件";
	}
	
	public function run($args) {
		parent::run($args);
	}
	
	public function actionIndex($type = "shell"){
		$dir = Yii::app()->getBasePath().'/../assets';
		$this->cleardir($dir, true, true);
		$dir = Yii::app()->getBasePath().'/runtime';
		$this->cleardir($dir, true, true);
		echo "Allclear is done!!\n";
		Yii::app()->end();
	}
	
	private function cleardir($dir,$forceclear=false,$log=FALSE) {
		if(!is_dir($dir)){
			return;
		}
		$directory=dir($dir);
		while($entry=$directory->read()){
			$filename=$dir.'/'.$entry;
			if ($log) {
				echo $filename."\n";
			}
			if(is_file($filename)){
				@unlink($filename);
			}elseif(is_dir($filename)&&$forceclear&&$entry!='.'&&$entry!='..'){
				chmod($filename,0777);
				$this->cleardir($filename,$forceclear);
				rmdir($filename);
			}
		}
		$directory->close();
	}
}

?>
