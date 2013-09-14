<?php

class WeiboController extends IeltseyeController {

    public $pageTitle = '';

    public function filters() {
        return array(
//            array(
//                'CHttpCacheFilter + index',
//                'lastModified' => intval(Yii::app()->db->createCommand("SELECT MAX(`dateline`) FROM {{ieltseye_weibo}}")->queryScalar()),
//            ),
        );
    }

    public function actionIndex() {
        $model = new IeltseyeWeibo();
        $data = $model->getWeibo();
        $this->render('index', array('model' => $model,
            'data' => $data,
            )
        );
    }

    public function actionSearch() {
        $model = new IeltseyeWeibo();
        $keyword = Yii::app()->request->getParam('keyword');
        $data = $model->getWeibo($keyword);
        $this->render('search', array('model' => $model,
            'data' => $data,
            )
        );
    }

    // Uncomment the following methods and override them if needed
    /*
    public function actions() {
        // return external action classes, e.g.:
        return array(
            'action1' => 'path.to.ActionClass',
            'action2' => array(
                'class' => 'path.to.AnotherActionClass',
                'propertyName' => 'propertyValue',
            ),
        );
    }
     
    */

}