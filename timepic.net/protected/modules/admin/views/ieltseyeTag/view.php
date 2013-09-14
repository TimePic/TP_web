<?php
$this->breadcrumbs=array(
	'Ieltseye Tags'=>array('index'),
	$model->tagid,
);

$this->menu=array(
	array('label'=>'List IeltseyeTag','url'=>array('index')),
	array('label'=>'Create IeltseyeTag','url'=>array('create')),
	array('label'=>'Update IeltseyeTag','url'=>array('update','id'=>$model->tagid)),
	array('label'=>'Delete IeltseyeTag','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->tagid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IeltseyeTag','url'=>array('admin')),
);
?>

<h1>View IeltseyeTag #<?php echo $model->tagid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'tagid',
		'tagname',
		'aliasWords',
		'status',
	),
)); ?>
