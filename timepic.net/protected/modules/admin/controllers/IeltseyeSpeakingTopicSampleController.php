<?php

class IeltseyeSpeakingTopicSampleController extends adminController
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
		$model=new IeltseyeSpeakingTopicSample;
        if($model->isNewRecord){
            $model->cardid = Yii::app()->request->getParam('id');
        }
        $window = Yii::app()->request->getParam('window');
        $card = IeltseyeSpeakingTopicCard::model()->findByPk($model->cardid);


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['IeltseyeSpeakingTopicSample']))
		{
			$model->attributes=$_POST['IeltseyeSpeakingTopicSample'];
            if($model->save()){
                if ($window == 'true') {
                    echo "ok";
                    Yii::app()->end();
                }else{
                    $this->redirect(array('view','id'=>$model->sampleid));                    
                }
            }

		}
        if ($window == 'true') {
            $this->renderPartial('createAjax',array(
                    'model'=>$model,
                    'card' => $card,
                ),FALSE,TRUE
            );
        }else{
            $this->render('create',array(
                'model'=>$model,
                'card' => $card,
            ));            
        }

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $card = IeltseyeSpeakingTopicCard::model()->findByPk($model->cardid);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['IeltseyeSpeakingTopicSample']))
		{
			$model->attributes=$_POST['IeltseyeSpeakingTopicSample'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->sampleid));
		}

		$this->render('update',array(
			'model'=>$model,
            'card' => $card,
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
		$dataProvider=new CActiveDataProvider('IeltseyeSpeakingTopicSample');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IeltseyeSpeakingTopicSample('search');
        $model->with('topicCard');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IeltseyeSpeakingTopicSample']))
			$model->attributes=$_GET['IeltseyeSpeakingTopicSample'];

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
		$model=IeltseyeSpeakingTopicSample::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ieltseye-speaking-topic-sample-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
