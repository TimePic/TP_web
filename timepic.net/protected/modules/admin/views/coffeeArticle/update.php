<?php
$this->breadcrumbs=array(
	'咖啡教程'=>array('index'),
	$model->title=>array('view','id'=>$model->aid),
	'修改',
);

$this->menu=array(
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
	array('label'=>'新建','url'=>array('create')),
	array('label'=>'查看','url'=>array('view','id'=>$model->aid)),

);

?>

<h1>Update CoffeeArticle <?php echo $model->aid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>