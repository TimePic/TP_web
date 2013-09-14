<?php
$this->breadcrumbs=array(
	'Msgboards'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Msgboard','url'=>array('index')),
	array('label'=>'Create Msgboard','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('msgboard-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Msgboards</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'msgboard-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'mid',
		'uid',
		'username',
		'email',
		array('name'=>'content', 'value'=>'CommonHelper::cutstr($data->content, 150)','htmlOptions'=>array('class'=>'linewrap')),
		array('name'=>'dateline', 'value'=>'date("Y-m-d H:i:s",$data->dateline)'),
		/*
		'status',
		'appid',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
