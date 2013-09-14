<?php
$this->breadcrumbs=array(
	'Totoro Videos'=>array('index'),
	$model->title=>array('view','id'=>$model->vid),
	'Update',
);

$this->menu=array(
	array('label'=>'List TotoroVideo','url'=>array('index')),
	array('label'=>'Create TotoroVideo','url'=>array('create')),
	array('label'=>'View TotoroVideo','url'=>array('view','id'=>$model->vid)),
	array('label'=>'Manage TotoroVideo','url'=>array('admin')),
);
?>

<h1>Update TotoroVideo <?php echo $model->vid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>