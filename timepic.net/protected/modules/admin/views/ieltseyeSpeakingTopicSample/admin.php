<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ieltseye-speaking-topic-sample-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ieltseye Speaking Topic Samples</h1>

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
	'id'=>'ieltseye-speaking-topic-sample-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sampleid',
        array(
            'name'=>'content',
                        'type'=>'html',
                        'headerHtmlOptions'=>array('width'=>'50%'),
                        'value'=>'"<p>
                                        <h5>
                                            <span class=\"badge badge-info\">Part ".$data->topicCard->type."</span>
                                            ".$data->topicCard->question."
                                        </h5>
                                   </p>
                                   <p>
                                            ".CommonHelper::cutstr(TimePicCode::TpCode($data->content), 300)."
                                   </p>
                                   <p class=\"muted\">".date("Y-m-d H:i:s", $data->dateline)."</p>"' 
        ),
		'author',
        array('name'=>'source', 'type'=>'html','value'=>'CHtml::link("URL", $data->source, array("target"=>"_blank"))', ),
        'cardid',
        'displayorder',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
