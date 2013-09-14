<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	'Manage',
);

$this->menu=array(
    array('label'=>'Manage','url'=>array('admin'), 'active' => true),
	array('label'=>'Create Part 2','url'=>array('create')),
    array('label'=>'Create Part 1 or 3','url'=>array('createPart13')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ieltseye-speaking-topic-card-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ieltseye Speaking Topic Cards</h1>

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
	'id'=>'ieltseye-speaking-topic-card-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cardid',
        array('name' => 'question',
            'type'=>'html',
            'headerHtmlOptions'=>array('width'=>'50%'),
            'value' => '"<h4>".$data->question."</h4><p class=\"muted\">".TimePicCode::TpCode($data->description)."<br />Tags: ".IeltseyeHelper::formatTags($data->tags, 1)."</p>"'),
		array('name' => 'type',  'headerHtmlOptions'=>array('width'=>'13%'), 'value' => '"Part ".$data->type', 'filter'=>array('1'=>'Part 1', '2'=>'Part 2', '3'=>'Part 3')),
        array('name' => 'dateline', 'value' => 'date("Y-m-d H:i:s", $data->dateline)'),
        array('name'=>'IeltseyeSpeakingTopicCardCount',
            'header'=>'Samples',
            'type'=>'html',
            'value'=> 'CHtml::link($data->IeltseyeSpeakingTopicCardCount,Yii::app()->createUrl(\'admin/ieltseyeSpeakingTopicSample/admin\', array(\'id\'=>$data->cardid)))',         
        ),
		array(
            'header'=>'操作',
            'headerHtmlOptions'=>array('width'=>'10%'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{createSample}{view}{update}{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'visible'=>'$data->IeltseyeSpeakingTopicCardCount == 0',
                ),
                'createSample' => array(
                    'label'=>'<i class="icon-plus"></i>',
                    'options'=>array('title'=>'创建例文'),
                    'url' => '"javascript:createSample(".$data->cardid.")"',
                ),
            ),
		),
	),
)); ?>

<div id="adminModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<script type="text/javascript">
    function createSample(id){
        $.get("/admin/ieltseyeSpeakingTopicSample/create/id/"+id+"?window=true", function(data) {
            $("#adminModal").html(data);
        });
        $('#adminModal').modal('show');
    }
</script>