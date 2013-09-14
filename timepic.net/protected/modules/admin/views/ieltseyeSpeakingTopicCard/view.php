<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	$model->cardid,
);

$this->menu=array(
	array('label'=>'List IeltseyeSpeakingTopicCard','url'=>array('index')),
	array('label'=>'Create IeltseyeSpeakingTopicCard','url'=>array('create')),
	array('label'=>'Update IeltseyeSpeakingTopicCard','url'=>array('update','id'=>$model->cardid)),
	array('label'=>'Delete IeltseyeSpeakingTopicCard','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->cardid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IeltseyeSpeakingTopicCard','url'=>array('admin')),
);
?>

<h1>View IeltseyeSpeakingTopicCard #<?php echo $model->cardid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'cardid',
		'question',
		'description',
		'type',
        'tags',
		'dateline',
	),
)); ?>
