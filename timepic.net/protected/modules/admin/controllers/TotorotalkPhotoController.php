<?php

class TotorotalkPhotoController extends adminController {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new TotorotalkPhoto;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TotorotalkPhoto'])) {
            $model->attributes = $_POST['TotorotalkPhoto'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->pid));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TotorotalkPhoto'])) {
            $model->attributes = $_POST['TotorotalkPhoto'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->pid));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            $image_origin = CommonHelper::getImageByType($model->filepath,'totorotalk' , "origin");
            $image_thumb = CommonHelper::getImageByType($model->filepath,'totorotalk', "thumb");
            $image_big = CommonHelper::getImageByType($model->filepath,'totorotalk', "big");
            $image_normal = CommonHelper::getImageByType($model->filepath,'totorotalk', "normal");
            if (file_exists($image_origin) && file_exists($image_thumb)) {
                @unlink($image_origin);
                @unlink($image_thumb);
                @unlink($image_normal);
                @unlink($image_big);
            }

            // we only allow deletion via POST request
            $model->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('TotorotalkPhoto');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new TotorotalkPhoto('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TotorotalkPhoto']))
            $model->attributes = $_GET['TotorotalkPhoto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /*     * *************************multi-upload*********************** */
	public function actionResize(){
		$model = $this->loadModel(1271);
//		$model = $this->loadModel(1274);
//		$model = $this->loadModel(1106);
		$file = CommonHelper::getImageByType($model->filepath,'totorotalk', "normal", 'path');
		
		$layer = new ImageWorkshop(array(
					"imageFromPath" => $file,
				));
		
		$layer->resizeInPixel(320, 480, true, 0, 0, 'MM');
		$image = $layer->getResult('000000'); // This is the generated image !
		
		header('Content-type: image/jpeg');

		imagejpeg($image, null, 95); // We choose to show a JPG with a quality of 95%
		exit;
	}
	public function actionWatermark(){
		$model = $this->loadModel('1118');

	}
	
	public function actionUploadDelete($id){
		if ($id) {
			$photos = Yii::app()->user->getState('totoroPhotos');
			if ($photos[$id]) {
				@unlink($photos[$id]['path']);
				@unlink($photos[$id]['thumb']);
				unset($photos[$id]);
				$photos = Yii::app()->user->setState('totoroPhotos', $photos);

			}
		}
		$this->redirect(array('/admin/totorotalkPhoto/readyUpload'));
	}
	
    public function actionReadyUpload() {
        $photos = Yii::app()->user->getState('totoroPhotos');
        if (isset($_POST['totorotalkReadyUpload'])) {
              $data = array();
              foreach($_POST['totorotalkReadyUpload'] as $key=>$title){
                  $model = new TotorotalkPhoto;
                  $photo = array(
                        'imgtype' => $photos[$key]['mime'],
                        'size' => $photos[$key]['size'],
                        'thumb' => 0,
                        'ip'=>Yii::app()->request->userHostAddress,
                        'title' => $title,
                        'filename'=> $photos[$key]['filename'],
                        'filepath'=> $photos[$key]['path'],
                        'dateline'=>time(),
                  );
                  if ($model->upload($photo, 1, 1)) {
                      unset($photos[$key]);
                  }
              }
              Yii::app()->user->setState('totoroPhotos', $photos);
              $this->redirect('admin');
        }
        $this->render('readyUpload', array(
            'photos' => $photos,
        ));
    }

    //bath to create
    public function actionMultiUpload() {
        
        Yii::import("xupload.models.XUploadForm");
        $photos = new XUploadForm;
        
        $this->render('multiUpload', array(
            'photos' => $photos,
        ));
    }

    public function actionUpload() {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = Yii::getPathOfAlias('webroot') . '/images/upload/tmp/';
        $publicPath = Yii::app()->params['site'] . "/images/upload/tmp/";
        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
						@unlink($path."thumb_".$_GET["file"]);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate()) {
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    //缩略图
                    $image = Yii::app()->image->load($path . $filename);
                    $image->resize(100, 150);
                    $image->save($path . 'thumb_' . $filename);
                    
                    list($imageWidth, $imageHeigh) = getimagesize($path.$filename);
                    
                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('totoroPhotos')) {
                        $userImages = Yii::app()->user->getState('totoroPhotos');
                    } else {
                        $userImages = array();
                    }
                    
                    $userImages[$filename] = array(
                        "path" => $path . $filename,
                        "url" => $publicPath.$filename,
                        "thumb" => $path.'thumb_' . $filename,
                        "thumbnail_url" => $publicPath."/thumb_$filename",
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                        'width' => $imageWidth,
                        'heigh' => $imageHeigh,
                    );
                    Yii::app()->user->setState('totoroPhotos', $userImages);

                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "thumbnail_url" => $publicPath . "/thumb_$filename",
                            "delete_url" => $this->createUrl("upload", array(
                            "_method" => "delete",
                            "file" => $filename
                            )),
                            "delete_type" => "POST"
                        )));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array("error" => $model->getErrors('file'),
                        )));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /*     * *************************multi-upload*********************** */

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = TotorotalkPhoto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'totorotalk-photo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
