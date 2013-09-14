<?php
$this->breadcrumbs=array(
	'Totorotalk百科'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'全部','url'=>array('index')),
	array('label'=>'新建','url'=>array('create')),
	array('label'=>'修改','url'=>array('update','id'=>$model->aid)),
	array('label'=>'删除','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
);
?>

<h1>View Totorotalk百科 #<?php echo $model->aid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'type'=>'condensed',
	'data'=>$model,
	'attributes'=>array(
		'aid',
		'title',
		'content',
		'image',
		'views',
		'thumbimg',
		'displayorder',
		array('name'=>'catid','value'=>  TotorotalkCategory::getTotoroCategory($model->catid)),
		array('name'=>"dateline", 'value'=>date("Y-m-d H:i:s", $model->dateline)),
	),
)); ?>
