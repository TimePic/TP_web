<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Create Sample</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'card'=>$card)); ?>