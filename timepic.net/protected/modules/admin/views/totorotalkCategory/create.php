<?php
$this->breadcrumbs=array(
	'Totorotalk Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TotorotalkCategory','url'=>array('index')),
	array('label'=>'Manage TotorotalkCategory','url'=>array('admin')),
);
?>

<h1>Create TotorotalkCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>