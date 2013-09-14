<?php
$this->breadcrumbs=array(
	'Msgboards'=>array('index'),
	$model->mid,
);

$this->menu=array(
	array('label'=>'List Msgboard','url'=>array('index')),
	array('label'=>'Create Msgboard','url'=>array('create')),
	array('label'=>'Update Msgboard','url'=>array('update','id'=>$model->mid)),
	array('label'=>'Delete Msgboard','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->mid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Msgboard','url'=>array('admin')),
);
?>

<h1>View Msgboard #<?php echo $model->mid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'mid',
		'uid',
		'username',
		'email',
		'content',
		array('name'=>"dateline", 'value'=>date("Y-m-d H:i:s", $model->dateline)),
		'status',
		'appid',
	),
)); ?>
