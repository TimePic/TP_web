<?php
$this->breadcrumbs=array(
	'Totorotalk Categories'=>array('index'),
	$model->catid,
);

$this->menu=array(
	array('label'=>'List TotorotalkCategory','url'=>array('index')),
	array('label'=>'Create TotorotalkCategory','url'=>array('create')),
	array('label'=>'Update TotorotalkCategory','url'=>array('update','id'=>$model->catid)),
	array('label'=>'Delete TotorotalkCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->catid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TotorotalkCategory','url'=>array('admin')),
);
?>

<h1>View TotorotalkCategory #<?php echo $model->catid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'catid',
		'upid',
		'catname',
	),
)); ?>
