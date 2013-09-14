<?php
$this->breadcrumbs=array(
	'Totorotalk百科'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'全部','url'=>array('index')),
	array('label'=>'新建','url'=>array('create')),
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('totorotalk-article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Totorotalk百科</h1>

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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'totorotalk-article-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'aid',
		'title',
		array('name'=>'content', 'value'=>'CommonHelper::cutstr($data->content, 300)'),
		'image',
		'thumbimg',
		array('name' => 'dateline', 'value' => 'date("Y-m-d H:i:s", $data->dateline)'),
		'views',
		array('name'=>'catid','value'=>  'TotorotalkCategory::getTotoroCategory($data->catid)','filter'=>TotorotalkCategory::getTotoroCategorys()),
		'displayorder',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
