<?php

class ArticleController extends Controller
{
	public function actionIndex()
	{
		exit('error');
	}

	public function actionList() {
		$data = $jsondata = array();
		$query = Yii::app()->db->createCommand()->select('a.*, c.catname, c.catid')->from('{{totorotalk_article}} a')->leftJoin('{{totorotalk_category}} c', 'a.catid=c.catid')->limit('100')->order('displayorder DESC, dateline')->query();
		while ($row = $query->read()) {
			$row['id'] = intval($row['aid']);
			unset($row['aid']);
			$row['dateline'] = date("Y-m-d H:i:s", $row['dateline']);
			$row['title'] = $row['catid'] ? $row['catname'].'-'.CommonHelper::cutstr($row['title'], 24) : CommonHelper::cutstr($row['content'], 24);
			$row['content'] = CommonHelper::cutstr($row['content'], 300);
			$data[] = $row;
		}
		$jsondata['datas'] = $data;
		echo json_encode($jsondata);
		Yii::app()->end();
	}
        
        public function actionListPage($page) {
                $page = $page ? intval($page) : '1';
		$pagenum = 20;
		if($page){
			$offset = ($page -1) * $pagenum;
			$limit = $pagenum;
		}
		$data = $jsondata = array();
		$query = Yii::app()->db->createCommand()->select('a.*, c.catname, c.catid')->from('{{totorotalk_article}} a')->leftJoin('{{totorotalk_category}} c', 'a.catid=c.catid')->limit($limit, $offset)->order('displayorder DESC, dateline')->query();
		while ($row = $query->read()) {
			$row['id'] = intval($row['aid']);
			unset($row['aid']);
			$row['dateline'] = date("Y-m-d H:i:s", $row['dateline']);
			$row['title'] = $row['catid'] ? $row['catname'].'-'.CommonHelper::cutstr($row['title'], 24) : CommonHelper::cutstr($row['content'], 24);
			$row['content'] = CommonHelper::cutstr($row['content'], 300);
			$data[] = $row;
		}
		$jsondata['datas'] = $data;
		echo json_encode($jsondata);
		Yii::app()->end();
	}
	
	public function actionGetinfo($id) {
		$data = $jsondata = array();
		$item = Yii::app()->db->createCommand()->select('*')->from('{{totorotalk_article}}')->where(' aid=:aid', array(':aid'=>$id))->queryRow();
		Yii::app()->db->createCommand()->update("{{totorotalk_article}}", array('views'=>new CDbExpression('views+1')), 'aid=:aid',array(':aid'=>$id));
		$item['dateline'] = date("Y-m-d H:i:s", $item['dateline']);
		$jsondata['datas'][0] = $item;
		echo json_encode($jsondata);
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