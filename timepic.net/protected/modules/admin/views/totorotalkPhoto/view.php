<?php
$this->breadcrumbs=array(
	'Totorotalk Photos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List TotorotalkPhoto','url'=>array('index')),
	array('label'=>'Create TotorotalkPhoto','url'=>array('create')),
	array('label'=>'Update TotorotalkPhoto','url'=>array('update','id'=>$model->pid)),
	array('label'=>'Delete TotorotalkPhoto','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->pid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TotorotalkPhoto','url'=>array('admin')),
);
?>

<h1>View TotorotalkPhoto #<?php echo $model->pid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'pid',
		'ip',
		'title',
		'imgtype',
		'size',
		'thumb',
		'filepath',
		'filename',
		'dateline',
	),
)); ?>
