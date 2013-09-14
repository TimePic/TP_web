<?php
$this->breadcrumbs=array(
	'Totorotalk Photos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TotorotalkPhoto','url'=>array('index')),
	array('label'=>'Manage TotorotalkPhoto','url'=>array('admin')),
);
?>

<h1>Create TotorotalkPhoto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>