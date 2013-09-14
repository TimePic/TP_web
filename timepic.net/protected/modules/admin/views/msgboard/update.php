<?php
$this->breadcrumbs=array(
	'Msgboards'=>array('index'),
	$model->mid=>array('view','id'=>$model->mid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Msgboard','url'=>array('index')),
	array('label'=>'Create Msgboard','url'=>array('create')),
	array('label'=>'View Msgboard','url'=>array('view','id'=>$model->mid)),
	array('label'=>'Manage Msgboard','url'=>array('admin')),
);
?>

<h1>Update Msgboard <?php echo $model->mid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>