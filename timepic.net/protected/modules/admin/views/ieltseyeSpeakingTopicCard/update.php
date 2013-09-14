<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	$model->cardid=>array('view','id'=>$model->cardid),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->cardid)),
	array('label'=>'Manage','url'=>array('admin')),
);
?>

<h1>Update IeltseyeSpeakingTopicCard <?php echo $model->cardid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>