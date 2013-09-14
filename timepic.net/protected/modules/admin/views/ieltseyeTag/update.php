<?php
$this->breadcrumbs=array(
	'Ieltseye Tags'=>array('index'),
	$model->tagid=>array('view','id'=>$model->tagid),
	'Update',
);

$this->menu=array(
	array('label'=>'List IeltseyeTag','url'=>array('index')),
	array('label'=>'Create IeltseyeTag','url'=>array('create')),
	array('label'=>'View IeltseyeTag','url'=>array('view','id'=>$model->tagid)),
	array('label'=>'Manage IeltseyeTag','url'=>array('admin')),
);
?>

<h1>Update IeltseyeTag <?php echo $model->tagid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>