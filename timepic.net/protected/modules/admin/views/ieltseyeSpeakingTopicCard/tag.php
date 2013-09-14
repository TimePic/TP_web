<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
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

<h1>Manage Ieltseye Speaking Topic</h1>
<p><span class="label label-important"><?php echo $tag->tagname;?></span></p>

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
