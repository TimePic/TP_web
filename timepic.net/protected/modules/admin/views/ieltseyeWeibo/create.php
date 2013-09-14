<?php
$this->breadcrumbs=array(
	'Ieltseye Weibos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IeltseyeWeibo','url'=>array('index')),
	array('label'=>'Manage IeltseyeWeibo','url'=>array('admin')),
);
?>

<h1>Create IeltseyeWeibo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>