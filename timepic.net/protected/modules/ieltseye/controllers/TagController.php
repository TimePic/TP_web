<?php

class TagController extends IeltseyeController
{
	public function actionIndex() {
        $tagsCache = IeltseyeCache::loadCache('Tags');
        if (!empty($tagsCache)) {

            foreach ($tagsCache as $tag) {
                $tagsData[ucwords($tag['tagname'])] = $tag['tagid'];
                $tagsWithoutAlias[ucwords($tag['tagname'])] = $tag['tagid'];
                if ($tag['aliasWords']) {
                    $aliasWords = explode(',', $tag['aliasWords']);
                    if ($aliasWords) {
                        foreach ($aliasWords as $aliasWord) {
                            $tagsData[ucwords($aliasWord)] = $tag['tagid'];
                        }
                    }
                }
            }
        }
        ksort($tagsWithoutAlias);
        $this->render('index', array(
            'tagsWithoutAlias' => $tagsWithoutAlias,
            'tagsData' => $tagsData,
            'tagsCache' => $tagsCache,
            )
        );
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