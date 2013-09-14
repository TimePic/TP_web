<?php

class SampleController extends IeltseyeController {

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => '10',
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionSpeakingTopic($id) {
        $topicCard = $dataprovider = '';
        $topicCard = IeltseyeSpeakingTopicCard::model()->findByPk($id);
        $dataprovider = new CActiveDataProvider('IeltseyeSpeakingTopicSample', array(
            'criteria' => array(
                'condition' => 'cardid=' . intval($id),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
            'sort' => array(
                'defaultOrder' => array('dateline' => 'CSort::SORT_DESC'),
            )
            )
        );
        $this->render('speakingTopic', array(
            'dataprovider' => $dataprovider,
            'topicCard' => $topicCard,
        ));
    }

    public function actionSpeakingView($id) {
        $topicCard = $dataprovider = '';
        $sample = IeltseyeSpeakingTopicSample::model()->with('topicCard')->findByPk($id);
        $this->render('speakingView', array(
            'sample' => $sample,
        ));
    }

    public function actionCreate($id) {
        $model = new IeltseyeSpeakingTopicSample('userCreate');
        
        // Uncomment the following line if AJAX validation is needed
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'IELTSeyeSpeakingSampleForm') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['IeltseyeSpeakingTopicSample'])) {
            $model->attributes = $_POST['IeltseyeSpeakingTopicSample'];
            $model->dateline = time();
            $model->displayorder = 0;
            if ($model->save()){
                if(Yii::app()->getRequest()->getIsAjaxRequest()){
                    echo "ok";
                    Yii::app()->end();
                }else{
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
            }
                
        }
        
        $topicCard = IeltseyeSpeakingTopicCard::model()->findByPk($id);
        if(Yii::app()->getRequest()->getIsAjaxRequest()) {
            $this->renderPartial('create', array(
                'model' => $model,
                'topicCard' => $topicCard,
            ), false, true);
        }else{
//            $this->render('create', array(
//                'model' => $model,
//            ));
        }

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