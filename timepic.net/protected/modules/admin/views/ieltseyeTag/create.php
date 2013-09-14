<?php
$this->breadcrumbs=array(
	'Ieltseye Tags'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IeltseyeTag','url'=>array('index')),
	array('label'=>'Manage IeltseyeTag','url'=>array('admin')),
);
?>

<h1>Create IeltseyeTag</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>