<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage','url'=>array('admin')),
	array('label'=>'Create Part 2','url'=>array('create'), 'active' => true),
    array('label'=>'Create Part 1 or 3','url'=>array('createPart13')),
);
?>

<h1>Create Ieltseye Speaking TopicCard</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ieltseye-speaking-topic-card-form-part2',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnChange'=>true
    ),
)); ?>
    <h3>Part 2</h3>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model, 'type', array('2'=>'Part 2') , array('class'=>'span5', 'disabled'=>true, 'options'=>array('2'=>array('selected'=>'selected')))); ?>
    <?php echo $form->textFieldRow($model,'tags',array("autocomplete"=>"off", 'class'=>'span6','id'=>'tags','maxlength'=>255)); ?>
    
	<?php echo $form->textAreaRow($model,'question',array('rows'=>3, 'cols'=>50, 'class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php 
    $tagsCache = IeltseyeCache::loadCache("Tags");
    foreach($tagsCache as $tagid=>$tagItem){
        $Item = $tagItem['tagname'];
        $tagaArray[] = $Item;
    }
    $tagsData = json_encode($tagaArray);
?>
<script type="text/javascript">
$('#tags').typeahead({
    'source':<?php echo $tagsData;?>
});
</script>