<?php
$this->pageTitle = Yii::app()->params['ieltseye']['seoTitle']."-雅思口语考题实时回忆-Keyword-".$data['keyword'];
$this->breadcrumbs=array(
	'IELTS Speaking WeiBo'=>array('/weibo/index/'),
    'Search:'.$data['keyword'],
);
?>
<?php $this->renderpartial('_weiboItem', array('data'=>$data));?>