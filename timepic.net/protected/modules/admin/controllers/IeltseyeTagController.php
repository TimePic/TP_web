<?php

class IeltseyeTagController extends adminController
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
		$model=new IeltseyeTag;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['IeltseyeTag']))
		{
			$model->attributes=$_POST['IeltseyeTag'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->tagid));
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

		if(isset($_POST['IeltseyeTag']))
		{
			$model->attributes=$_POST['IeltseyeTag'];
            if($model->save()){
                //update all tagItem
                IeltseyeTagitem::model()->updateAll(array('tagname'=>$model->tagname),'tagid=:tagid', array(':tagid'=>$model->tagid));
                //update all cards
                IeltseyeTag::model()->updateCard($model->tagid);
                //force reload cache
                IeltseyeCache::loadCache('Tags', true);
                
				$this->redirect(array('view','id'=>$model->tagid));                
            }

		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    
    public function actionMerge(){
        $model=new IeltseyeTag('merge');
        if (isset($_POST['IeltseyeTag'])) {
            $model->attributes=$_POST['IeltseyeTag'];
            if ($model->validate(array('fromTagid', 'toTagid'))) {
                $model->mergeTags($model->fromTagid, $model->toTagid);
                $this->redirect(array('admin')); 
            }

        }

		$this->render('merge',array(
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
            IeltseyeTag::model()->updateCard($id, 'delete');
            IeltseyeTagitem::model()->deleteAll('tagid=:tagid', array(':tagid'=>$id));
			$this->loadModel($id)->delete();
            //update all cards

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
		$dataProvider=new CActiveDataProvider('IeltseyeTag');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IeltseyeTag('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IeltseyeTag']))
			$model->attributes=$_GET['IeltseyeTag'];

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
		$model=IeltseyeTag::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ieltseye-tag-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
