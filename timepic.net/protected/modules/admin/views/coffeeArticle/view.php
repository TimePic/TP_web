<?php
$this->breadcrumbs=array(
	'咖啡教程'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
	array('label'=>'新建','url'=>array('create')),
	array('label'=>'修改','url'=>array('update','id'=>$model->aid)),
	array('label'=>'删除','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),

);
?>


<h1>View 咖啡教程 #<?php echo $model->aid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'aid',
		'title',
        array('name'=>'image','type'=>'html', 'value'=>  CHtml::link(
                CHtml::image(
                        Yii::app()->params['site'].'/images/upload/coffee/article/'.$model->filepath,
                        $model->filepath,
                        array('class'=>'image-polaroid')), 
                Yii::app()->params['site'].'/images/upload/coffee/article/'.$model->filepath,
                array('class'=>'lightbox'))),
        array('name'=>'content','type'=>'html', 'value'=>str_replace("\r\n", "<br />", $model->content)),
		array('name'=>'catid','value'=>$model->getCategoryById($model->catid)),
		array('name'=>"dateline", 'value'=>date("Y-m-d H:i:s", $model->dateline)),
		'tag',
        'displayorder',
		'source',
	),
)); ?>
