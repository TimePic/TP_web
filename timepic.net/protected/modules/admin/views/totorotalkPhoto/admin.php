<?php
$this->breadcrumbs=array(
	'Totorotalk热图'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
	array('label'=>'批量上传','url'=>array('multiUpload')),

);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('totorotalk-photo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Totorotalk Photos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.lightbox.js");?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/lightbox.css");?>
<?php
Yii::app()->clientScript->registerScript('admin_lightbox',"$('a.lightbox').lightBox();", CClientScript::POS_READY);
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'totorotalk-photo-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){$("a.lightbox").lightBox();}',
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'pid','type'=>'html','value'=>'CHtml::link(CHtml::encode($data->pid),array("view","id"=>$data->pid))'),
		'ip',
		'title',
		'imgtype',
		'size',
		'thumb',
		array('name'=>'filepath','type'=>'html', 'value'=>'CHtml::link(CHtml::image(CommonHelper::getImageByType($data->filepath, "totorotalk", "thumb", "url"), $data->filename), CommonHelper::getImageByType($data->filepath, "totorotalk", "origin", "url"), array("class"=>"lightbox"))'),
//		'filepath',
		'filename',
		array('name'=> 'dateline', 'value' => 'date("Y-m-d H:i:s", $data->dateline)'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
