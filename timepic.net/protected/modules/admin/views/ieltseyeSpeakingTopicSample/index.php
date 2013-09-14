<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples',
);

$this->menu=array(
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Ieltseye Speaking Topic Samples</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
