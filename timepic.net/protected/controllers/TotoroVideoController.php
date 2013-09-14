<?php

class TotoroVideoController extends TPController
{
	public $pageTitle = 'TimePic-龙猫-龙猫视频';
	
	public function actionIndex()
	{
		Yii::import('application.helpers.VideoUrlParser');
		require_once('VideoUrlParser.php');
                $videos = array();

                $criteria = new CDbCriteria();    
                $criteria->order = 'vid desc';        
                $count = TotoroVideo::model()->count($criteria);    

                $pager = new CPagination($count);    
                $pager->pageSize = 8;             
                $pager->applyLimit($criteria);    

                $videoList = totoroVideo::model()->findAll($criteria);    
                foreach ($videoList as $video) {
                       if ($video->url) {
                              $data = VideoUrlParser::parse($video->url);
                              $data['vid'] = $video->vid;
                              $data['html'] = '<embed src="'.$data['swf'].'" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
                              $videos[$video->vid] = $data;
                      }
                }
                $this->render('index',array('pages'=>$pager,'videos'=>$videos));
        }
}