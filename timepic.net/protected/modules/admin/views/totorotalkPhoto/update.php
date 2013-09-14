<?php
$this->breadcrumbs=array(
	'Totorotalk Photos'=>array('index'),
	$model->title=>array('view','id'=>$model->pid),
	'Update',
);

$this->menu=array(
	array('label'=>'List TotorotalkPhoto','url'=>array('index')),
	array('label'=>'Create TotorotalkPhoto','url'=>array('create')),
	array('label'=>'View TotorotalkPhoto','url'=>array('view','id'=>$model->pid)),
	array('label'=>'Manage TotorotalkPhoto','url'=>array('admin')),
);
?>

<h1>Update TotorotalkPhoto <?php echo $model->pid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>