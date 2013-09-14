<?php
$this->breadcrumbs=array(
	'Msgboards'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'List Msgboard','url'=>array('index')),
	array('label'=>'Manage Msgboard','url'=>array('admin')),
);
?>

<h1>Create Msgboard</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>