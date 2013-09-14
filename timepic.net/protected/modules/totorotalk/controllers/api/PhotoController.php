<?php

class PhotoController extends Controller
{

	public function actionUploadPhoto(){
		$model = new TotorotalkPhoto; 

		if (isset ($_FILES['TotorotalkPhoto'])) {

			$file = CUploadedFile::getInstanceByName('TotorotalkPhoto[totoroPhoto]');
		
			if(is_object($file)){
				$path = Yii::getPathOfAlias('webroot') . '/images/upload/tmp/';
				$filename = date('His').strtolower(CommonHelper::random(16));
				$filename .= "." . $file->getExtensionName();
				
				$file->saveAs($path . $filename);
				
                $photo = array(
                        'imgtype' => $file->getType(),
                        'size' => $file->getSize(),
                        'thumb' => 0,
                        'ip'=>Yii::app()->request->userHostAddress,
                        'title' => addslashes(Yii::app()->request->getParam('title')),
                        'filename'=> $filename,
                        'filepath'=> $path.$filename,
                        'dateline'=>time(),
                  );
			}else{
				$data['datas'][]['code'] = '0';
				Yii::app()->end(json_encode($data));
			}
			
			$model->upload($photo, 1, 1);
			$data['datas'][]['code'] = '1';
			Yii::app()->end(json_encode($data));
		}
		$data['datas'][]['code'] = '0';
		Yii::app()->end(json_encode($data));		
//		$this->render('index',array(
//			'model'=>$model,
//		));

	}
	
	public function actionPhotoList($page){
		if (0 && $_GET['key'] != 'fa299ad0fc857f005b03fb5670d1e2ca') {
			$jsonmessage['datas'] = '';
			$jsonmessage['total'] = '0';
			echo json_encode($jsonmessage);
			Yii::app()->end();
		}
		$result = $jsonmessage = array();
		
		$page = $page ? intval($page) : '1';
		$pagenum = 20;
		if($page){
			$offset = ($page -1) * $pagenum;
			$limit = $pagenum;
		}
		$total = Yii::app()->db->createCommand()->select("count(*) AS total")->from("{{totorotalk_photo}}")->query()->read();
		if($total){
			$query = Yii::app()->db->createCommand()->select("*")->from("{{totorotalk_photo}}")->limit($limit, $offset)->order('dateline DESC')->query();
			while($row = $query->read()) {
				$row['dateline'] = date("Y-m-d H:i:s", $row['dateline']);
				if($row['filepath']){
					if (!file_exists(CommonHelper::getImageByType($row['filepath'], "totorotalk", 'normal'))) {
						$row['image'] = CommonHelper::getImageByType($row['filepath'], "totorotalk", "origin", 'url');			
					}else{
						$row['image'] = CommonHelper::getImageByType($row['filepath'], "totorotalk", "normal", 'url');			
					}

					if ($row['thumb']) {
						$row['thumb'] = CommonHelper::getImageByType($row['filepath'], "totorotalk", "thumb", 'url');
					}else{
						$row['thumb'] = $row['image'];					
					}
				}
				$result[] = $row;
			}
			$jsonmessage['datas'] = $result;
			$jsonmessage['total'] = @ceil($total['total']/$pagenum);
			echo json_encode($jsonmessage);
			Yii::app()->end();
		}
		$jsonmessage['datas'] = '';
		$jsonmessage['total'] = '0';
		echo json_encode($jsonmessage);
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
