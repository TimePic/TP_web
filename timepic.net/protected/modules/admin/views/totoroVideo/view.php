<?php
$this->breadcrumbs=array(
	'Totoro Videos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TotoroVideo','url'=>array('index')),
	array('label'=>'Create TotoroVideo','url'=>array('create')),
	array('label'=>'Update TotoroVideo','url'=>array('update','id'=>$model->vid)),
	array('label'=>'Delete TotoroVideo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->vid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TotoroVideo','url'=>array('admin')),
);
?>

<h1>View TotoroVideo #<?php echo $model->vid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'vid',
		'url:url',
		'title',
		'thumb:image',
		'dateline:date',
	),
)); ?>
