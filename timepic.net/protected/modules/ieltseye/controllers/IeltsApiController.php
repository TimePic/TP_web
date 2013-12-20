<?php

class IeltsApiController extends Controller
{
	public function actionIndex()
	{
		$page = Yii::app()->request->getParam('page');
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
		$jsondata = $data = array();
		$page = $page ? intval($page) : 0;
		$pageSize = 7;
        //cache
        $dependency = new CDbCacheDependency('SELECT COUNT(*) FROM {{ieltseye_weibo}}');
        $command = Yii::app()->db->cache(3600, $dependency)->createCommand();
        
        $command->select('uid, screen_name, text, created_at');
        $command->from('{{ieltseye_weibo}}');
        
        //status -1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示
        $command->where('status >= 0');
        
        $command->order('created_at DESC');
        $command->limit($pageSize, $page*$pageSize);
        
        if (!empty($keyword)) {
            $command->where(array('like', 'text', '%'.$keyword.'%'));
        }

		$query = $command->queryAll();
		foreach($query as $row){
            //去掉@某人
            $row['text'] = preg_replace("/@[\\x{4e00}-\\x{9fa5}\\w\\-]+/u", "", $row['text']);
            if (!empty($keyword)) {
                $row['text'] = str_ireplace($keyword, '<span class="badge badge-info">'.$keyword.'</span>', CHtml::encode($row['text']));   
            }
            $row['created_at'] = CommonHelper::sgmdate('Y-m-d H:i:s', CHtml::encode($row['created_at']), 1);
			$data[] = $row;
		}
		$jsondata['datas'] = $data;
		header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json");
		$callback =  Yii::app()->request->getParam('callback');
		if ($callback) {
			echo Yii::app()->request->getParam('callback').'('.json_encode($jsondata).')';
		}else{
			echo json_encode($jsondata);
		}
		Yii::app()->end();
	}
    
   public function actionTweets()
	{
		$page = Yii::app()->request->getParam('page');
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
		$jsondata = $data = array();
		$page = $page ? intval($page) : 0;
		$pageSize = 7;
        //cache
        $dependency = new CDbCacheDependency('SELECT COUNT(*) FROM {{ieltseye_weibo}}');
        $command = Yii::app()->db->cache(3600, $dependency)->createCommand();
        
        $command->select('uid, screen_name, text, created_at');
        $command->from('{{ieltseye_weibo}}');
        
        //status -1 删除（隐藏） 0 抓取微博还没发 1 已经发送微博  2发送微博失败 大于0的 都可以显示
        $command->where('status >= 0');
        
        $command->order('created_at DESC');
        $command->limit($pageSize, $page*$pageSize);
        
        if (!empty($keyword)) {
            $command->where(array('like', 'text', '%'.$keyword.'%'));
        }

		$query = $command->queryAll();
		foreach($query as $row){
            //去掉@某人
            $row['text'] = preg_replace("/@[\\x{4e00}-\\x{9fa5}\\w\\-]+/u", "", $row['text']);
            $row['created_at'] = CommonHelper::sgmdate('Y-m-d H:i:s', CHtml::encode($row['created_at']), 1);
			$data[] = $row;
		}
		$jsondata['datas'] = $data;
        header("Content-type: application/json");
        echo json_encode($jsondata);
		Yii::app()->end();
	}
    
    public function actionVersion(){
        $data = array();
        $version = "1.0.2";
        $updateUrl = array(
            'iOS'=>Yii::app()->params['ieltseye']['appdownload']['iOS'],
            'Android'=>Yii::app()->params['ieltseye']['appdownload']['android'],
            'default'=>'http://www.ieltseye.com',
            );
        
        $platform = Yii::app()->request->getParam('platform');
        
        $data['updateUrl'] = $updateUrl[$platform] ? $updateUrl[$platform] : $updateUrl['default'];
        $data['version'] = $version;
        echo json_encode($data);
        Yii::app()->end();
    }
}
