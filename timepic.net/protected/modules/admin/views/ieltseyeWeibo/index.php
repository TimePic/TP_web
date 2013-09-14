<?php
$this->breadcrumbs=array(
	'Ieltseye Weibos',
);

$this->menu=array(
	array('label'=>'Create IeltseyeWeibo','url'=>array('create')),
	array('label'=>'Manage IeltseyeWeibo','url'=>array('admin')),
);
?>

<h1>Ieltseye Weibos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
