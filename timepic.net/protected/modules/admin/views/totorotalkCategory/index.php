<?php
$this->breadcrumbs=array(
	'Totorotalk Categories',
);

$this->menu=array(
	array('label'=>'Create TotorotalkCategory','url'=>array('create')),
	array('label'=>'Manage TotorotalkCategory','url'=>array('admin')),
);
?>

<h1>Totorotalk Categories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
