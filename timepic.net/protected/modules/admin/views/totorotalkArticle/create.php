<?php
$this->breadcrumbs=array(
	'Totorotalk百科'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'全部','url'=>array('index')),
	array('label'=>'新建','url'=>array('create'), 'active'=> true),
	array('label'=>'管理','url'=>array('admin')),
);
?>

<h1>Create Totorotalk百科</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>