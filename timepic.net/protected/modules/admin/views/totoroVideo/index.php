<?php
$this->breadcrumbs=array(
	'Totoro Videos',
);

$this->menu=array(
	array('label'=>'Create TotoroVideo','url'=>array('create')),
	array('label'=>'Manage TotoroVideo','url'=>array('admin')),
);
?>

<h1>Totoro Videos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
