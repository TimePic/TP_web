<?php
$this->breadcrumbs=array(
	'Totorotalk百科'=>array('index'),
	$model->title=>array('view','id'=>$model->aid),
	'修改',
);

$this->menu=array(
	array('label'=>'全部','url'=>array('index')),
	array('label'=>'新建','url'=>array('create')),
	array('label'=>'查看','url'=>array('view','id'=>$model->aid)),
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
);

?>

<h1>Update Totorotalk百科 <?php echo $model->aid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>