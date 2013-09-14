<?php
$this->breadcrumbs=array(
	'Ieltseye Weibos'=>array('index'),
	$model->eid,
);

$this->menu=array(
	array('label'=>'List IeltseyeWeibo','url'=>array('index')),
	array('label'=>'Create IeltseyeWeibo','url'=>array('create')),
	array('label'=>'Update IeltseyeWeibo','url'=>array('update','id'=>$model->eid)),
	array('label'=>'Delete IeltseyeWeibo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->eid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IeltseyeWeibo','url'=>array('admin')),
);
?>

<h1>View IeltseyeWeibo #<?php echo $model->eid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'eid',
		'uid',
		'uidstr',
		'screen_name',
		'wbid',
		'wbmid',
		'text',
		'created_at',
		'keywords',
		'dateline',
		'status',
		'source',
	),
)); ?>
