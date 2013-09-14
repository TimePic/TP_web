<?php
$this->breadcrumbs=array(
	'Ieltseye Tags',
);

$this->menu=array(
	array('label'=>'Create IeltseyeTag','url'=>array('create')),
	array('label'=>'Manage IeltseyeTag','url'=>array('admin')),
);
?>

<h1>Ieltseye Tags</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
