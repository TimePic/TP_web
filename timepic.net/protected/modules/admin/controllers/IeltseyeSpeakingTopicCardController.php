<?php

class IeltseyeSpeakingTopicCardController extends adminController
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
		$model=new IeltseyeSpeakingTopicCard('part2');
        
		// Uncomment the following line if AJAX validation is needed
//		if(isset($_POST['ajax']) && $_POST['ajax']== 'ieltseye-speaking-topic-card-form-part2'){
//            //ieltseye-speaking-topic-card-form-part13
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}

		if(isset($_POST['IeltseyeSpeakingTopicCard']))
		{
			$model->attributes=$_POST['IeltseyeSpeakingTopicCard'];
            $model->type = 2;
            $model->question = ucfirst(trim($model->question));
            $model->description = trim($model->description);
            
            if($model->save()){
               $this->redirect(array('admin'));                
            }

		}
        $model->tags = IeltseyeHelper::formatTags($model->tags);
		$this->render('createPart2',array(
			'model'=>$model,
		));
	}
    
    public function actionCreatePart13(){
		$model=new IeltseyeSpeakingTopicCard('Part13');
        //默认填充9个question
        $model->questions = array_pad(array(), 14, '');
        
		// Uncomment the following line if AJAX validation is needed
		if(isset($_POST['ajax']) && $_POST['ajax']== 'ieltseye-speaking-topic-card-form-part13'){
            //ieltseye-speaking-topic-card-form-part13
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['IeltseyeSpeakingTopicCard']))
		{
			$model->attributes=$_POST['IeltseyeSpeakingTopicCard'];
            $model->questions = $_POST['IeltseyeSpeakingTopicCard']['questions'];
            if (isset($_POST['IeltseyeSpeakingTopicCard']['questions'])) {
                if ($model->validate('questions')) {
                   foreach($model->questions as $key=>$question){
                       if (!empty($question)) {
                           $model->type = $_POST['IeltseyeSpeakingTopicCard']['type'];
                           $model->question = ucfirst(trim($question));
                           $model->tags = $_POST['IeltseyeSpeakingTopicCard']['tags'];
                           $model->cardid = NULL;
                           $model->setIsNewRecord(true);
                           $model->save();
                       }
                   }
                   $this->redirect(array('admin'));
                }
            }
		}
        $model->tags = IeltseyeHelper::formatTags($model->tags);
		$this->render('createPart13',array(
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

		if(isset($_POST['IeltseyeSpeakingTopicCard']))
		{
			$model->attributes=$_POST['IeltseyeSpeakingTopicCard'];
            $model->question = ucfirst(trim($model->question));
            $model->description = trim($model->description);
			if($model->save())
				$this->redirect(array('view','id'=>$model->cardid));
		}
        $model->tags = IeltseyeHelper::formatTags($model->tags);
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
            //delete tagItem
            IeltseyeTagitem::model()->deleteAll('idtype=:idtype AND itemid=:itemid', array(':idtype'=>'cardid', ':itemid'=>$id));
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
		$dataProvider=new CActiveDataProvider('IeltseyeSpeakingTopicCard');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
	public function actionTag($id)
	{
        $tag = IeltseyeTag::model()->findByPk($id);
		$model=new IeltseyeSpeakingTopicCard('search');
        $criteria = $model->getDbCriteria();

        $criteria->with = array(
            'tagItem'=>array(
                'condition'=>'tagItem.tagid='.$id,
            ) 
        );
        $criteria->order = "type ASC, cardid DESC";
        $model->setDbCriteria($criteria);
        
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IeltseyeSpeakingTopicCard']))
			$model->attributes=$_GET['IeltseyeSpeakingTopicCard'];
        
		$this->render('tag',array(
			'model'=>$model,
            'tag'=>$tag,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IeltseyeSpeakingTopicCard('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['IeltseyeSpeakingTopicCard']))
			$model->attributes=$_GET['IeltseyeSpeakingTopicCard'];

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
		$model=IeltseyeSpeakingTopicCard::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ieltseye-speaking-topic-card-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
