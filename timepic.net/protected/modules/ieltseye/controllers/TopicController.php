<?php

class TopicController extends IeltseyeController
{    
    public function actionIndex($part="2")
	{
        $this->redirect('/topic/part2');
	}
    
    public function actionPart1(){
        $keyword = '';
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
        $dataProvider = IeltseyeSpeakingTopicCard::model()->getPart(1);
		$this->render('part1',
                    array('dataProvider'=>$dataProvider,
                        'keyword'=>$keyword,
                    )
				);
    }
    
    public function actionPart2(){
        $keyword = '';
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword = strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
        $dataProvider = IeltseyeSpeakingTopicCard::model()->getPart(2);
		$this->render('part2',
                    array('dataProvider'=>$dataProvider,
                        'keyword'=>$keyword,
                    )
				);
    }
    
    public function actionPart3(){
        $keyword = '';
        if (Yii::app()->request->getParam('keyword')) {
            $keyword = Yii::app()->request->getParam('keyword');
            $keyword=strtr($keyword, array('%'=>'\%', '_'=>'\_'));
        }
        $dataProvider = IeltseyeSpeakingTopicCard::model()->getPart(3);
		$this->render('part3',
                    array('dataProvider'=>$dataProvider,
                        'keyword'=>$keyword,
                    )
				);
    }
    //tag
    public function actionTag($tag){
        $data = IeltseyeSpeakingTopicCard::model()->getPartByTag($tag);
		$this->render('tag',
                    array('dataProvider'=>$data['dataProvider'],
                        'keyword'=>$data['tagname'],
                    )
				);
    }
    
    public function actionTagList(){
        var_dump($this->tags);
        exit;
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