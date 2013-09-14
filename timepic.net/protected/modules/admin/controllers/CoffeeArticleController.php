<?php

class CoffeeArticleController extends adminController
{       
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CoffeeArticle;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CoffeeArticle']))
		{
			$model->attributes=$_POST['CoffeeArticle'];
            
            //upload the image
            $model->image = CUploadedFile::getInstance($model,'image');

            if (!empty($model->image) && $model->validate()) {
                $filename = date('His').strtolower(CommonHelper::random(16)).'.jpg';

                $model->filepath = CommonHelper::makepath().$filename;

                $uploadPath = CommonHelper::makepath(Yii::getPathOfAlias('webroot').'/images/upload/coffee/article/');
                if (!file_exists($uploadPath)) {
                    Time_FileHelper::forcemkdir($uploadPath);
                }
                $model->image->saveAs($uploadPath.$filename, true);                
            }
            
			if($model->save()){
				$this->redirect(array('view','id'=>$model->aid));                
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CoffeeArticle']))
		{
			$model->attributes=$_POST['CoffeeArticle'];
            //upload the image
            $model->image = CUploadedFile::getInstance($model,'image');
            //修改附件
            if (!empty($model->image)) {
                $filename =  $model->filepath?  pathinfo($model->filepath,PATHINFO_BASENAME) : date('His').strtolower(CommonHelper::random(16)).'.jpg';

                $model->filepath = $model->filepath ? $model->filepath :CommonHelper::makepath().$filename;

                $uploadPath = CommonHelper::makepath(Yii::getPathOfAlias('webroot').'/images/upload/coffee/article/');
                if (!file_exists($uploadPath)) {
                    Time_FileHelper::forcemkdir($uploadPath);
                }
                
                if (file_exists($uploadPath.$filename)) {
                    unlink($uploadPath.$filename);
                }
                
                $model->image->saveAs($uploadPath.$filename, true);                
            }
            //删除附件
            if ($_POST['CoffeeArticle']['del_image']) {
                $delfilename = Yii::getPathOfAlias('webroot').'/images/upload/coffee/article/'.$model->filepath;
                if (file_exists($delfilename)) {
                    @unlink($delfilename);
                }
                $model->filepath = '';
            }
            
			if($model->save()){
				$this->redirect(array('view','id'=>$model->aid));                
            }

		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            //删除附件
            $file = Yii::getPathOfAlias('webroot').'/images/upload/coffee/article/'.$this->loadModel($id)->filepath;
            if(file_exists($file)){
                @unlink($file);
            }
            $this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CoffeeArticle');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CoffeeArticle('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CoffeeArticle']))
			$model->attributes=$_GET['CoffeeArticle'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CoffeeArticle::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='coffee-article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
