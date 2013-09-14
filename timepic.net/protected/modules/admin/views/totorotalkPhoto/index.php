<?php
$this->breadcrumbs=array(
	'Totorotalk Photos',
);

$this->menu=array(
	array('label'=>'Create TotorotalkPhoto','url'=>array('create')),
	array('label'=>'Manage TotorotalkPhoto','url'=>array('admin')),
);

?>

<h1>Totorotalk Photos</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array('name'=>'Pid', 'value'=>'$data->pid'),
		'title',
		'imgtype',
		'size',
		'thumb',
		array('name'=>'filepath','type'=>'html', 'value'=>'CHtml::link(CHtml::image(CommonHelper::getImageByType(Yii::app()->params["site"]."/images/upload/totorotalk/".$data->filepath, "totorotalk", "thumb"), $data->filename), CommonHelper::getImageByType(Yii::app()->params["site"]."/images/upload/totorotalk/".$data->filepath, "totorotalk", "origin"), array("target"=>"_blank"))'),
		'filename',
		array('name'=> 'dateline', 'value' => 'date("Y-m-d H:i:s", $data->dateline)'),
	),
)); ?>
