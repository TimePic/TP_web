<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples'=>array('index'),
	$model->sampleid=>array('view','id'=>$model->sampleid),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'View','url'=>array('view','id'=>$model->sampleid)),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Update IeltseyeSpeakingTopicSample <?php echo $model->sampleid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>