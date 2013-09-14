<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Create IeltseyeSpeakingTopicCard</h1>

<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>