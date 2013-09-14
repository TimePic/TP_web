<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards',
);

$this->menu=array(
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Ieltseye Speaking Topic Cards</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
