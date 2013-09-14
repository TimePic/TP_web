<?php
$this->breadcrumbs=array(
	'咖啡教程'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
    array('label'=>'新建','url'=>array('create')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('coffee-article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage 咖啡教程</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'coffee-article-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'aid',
		'title',
		array('name'=>'content', 'value'=>'CommonHelper::cutstr($data->content, 300)',),
		array('name'=>'catid','value'=>  'CoffeeArticle::getCategoryById($data->catid)','filter'=>$model->getCategorys()),
		array('name' => 'dateline', 'type'=>'date','value' => '$data->dateline'),
                'displayorder',
        array('name'=>'image','type'=>'image', 'value'=> 'Yii::app()->params["site"]."/images/upload/coffee/article/".$data->filepath'),
        'source:url',

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
