<?php
$this->breadcrumbs=array(
	'Coffee Articles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CoffeeArticle', 'url'=>array('index')),
	array('label'=>'Manage CoffeeArticle', 'url'=>array('admin')),
);
?>

<h1>Create 咖啡教程</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>