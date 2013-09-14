<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples'=>array('index'),
	$model->sampleid,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Update','url'=>array('update','id'=>$model->sampleid)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->sampleid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>View IeltseyeSpeakingTopicSample #<?php echo $model->sampleid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'sampleid',
		'content',
		'author',
        'email',
		'dateline',
		'source',
		'displayorder',
		'cardid',
	),
)); ?>
