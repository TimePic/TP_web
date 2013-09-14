<?php
$this->breadcrumbs=array(
	'Ieltseye Weibos'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List IeltseyeWeibo','url'=>array('index')),
//	array('label'=>'Create IeltseyeWeibo','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ieltseye-weibo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ieltseye Weibos</h1>

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
	'id'=>'ieltseye-weibo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'eid',
		'uid',
//		'uidstr',
		'wbid',
//		'wbmid',
		array('name'=>'text',
            'type'=>'html',
            'headerHtmlOptions'=>array('width'=>'40%'),
            'value'=>'"<p>".$data->text."</p>
                <p class=\"muted\">".$data->screen_name."--".date("Y/m/d H:i:s", $data->created_at)."</p>"',
            ),
		'keywords',
		array('name'=>'dateline', 'headerHtmlOptions'=>array('width'=>'10%'),'value'=>'date("Y-m-d H:i:s", $data->dateline)'),
        array('name' => 'status', 'value' => 'IeltseyeWeibo::model()->statusCode[$data->status]', 'filter'=>IeltseyeWeibo::model()->statusCode),
		array('name' => 'source', 'value' => 'IeltseyeWeibo::model()->sourceCode[$data->source]', 'filter'=>IeltseyeWeibo::model()->sourceCode),
		array(
            'headerHtmlOptions'=>array('width'=>'10%'),
            'template'=>'{switch}{view}{update}{delete}',
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'switch'=>array(
                    'label'=>'<i class="icon-lock"></i>',
                    'options'=>array('title'=>'隐藏'),
                    'url' => 'Yii::app()->createUrl("/admin/ieltseyeWeibo/statusSwitch",array("id"=>$data->eid, "status"=>"-1"))',
                    'click' => 'function(){return confirm("将不在主页及客户端显示。不发送微博。确认隐藏？");}',
                ),
                'delete'=>array(
                    'click'=>'function(){return confirm("来源为搜索的微博建议1小时后删除，@我的则需要隐藏。否则会从微博自动同步回来。确认删除？");}',
                ),
            ),
		),
	),
)); ?>
