<?php

class DefaultController extends adminController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}