<?php
$this->breadcrumbs=array(
	'Ieltseye Weibos'=>array('index'),
	$model->eid=>array('view','id'=>$model->eid),
	'Update',
);

$this->menu=array(
	array('label'=>'List IeltseyeWeibo','url'=>array('index')),
	array('label'=>'Create IeltseyeWeibo','url'=>array('create')),
	array('label'=>'View IeltseyeWeibo','url'=>array('view','id'=>$model->eid)),
	array('label'=>'Manage IeltseyeWeibo','url'=>array('admin')),
);
?>

<h1>Update IeltseyeWeibo <?php echo $model->eid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>