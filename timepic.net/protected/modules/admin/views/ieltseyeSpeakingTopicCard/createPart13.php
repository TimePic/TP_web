<?php
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Cards'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage','url'=>array('admin')),
	array('label'=>'Create Part 2','url'=>array('create')),
    array('label'=>'Create Part 1 or 3','url'=>array('createPart13'),'active' => true),
);
?>

<h1>Create Ieltseye Speaking TopicCard</h1>

<?php $form=$this->beginWidget('CActiveForm',array(
	'id'=>'ieltseye-speaking-topic-card-form-part13',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnChange'=>true
    ),
)); ?>
    <h3>Part 1 or Part 3</h3>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, '' ,'', array('class'=>'alert alert-block alert-error')); ?>
    <?php echo $form->labelEx($model, 'type',array('class'=>'control-label'));?>
	<?php echo $form->dropDownList($model, 'type', array('1'=>'Part 1', '3'=>'Part 3') , array('class'=>'span6','options'=>array('2'=>array('selected'=>'selected')))); ?>
    <?php echo $form->error($model,'type', array('class'=>'help-inline error')); ?>
    
    <?php echo $form->labelEx($model, 'tags',array('class'=>'control-label'));?>
    <?php echo $form->textField($model,'tags',array("autocomplete"=>"off", 'id'=>"tags", 'class'=>'span6','maxlength'=>255)); ?>
    <?php echo $form->error($model,'tags', array('class'=>'help-inline error')); ?>
    <?php
        foreach($model->questions  as $key=>$question){
            echo CHtml::label('questions'.($key+1), '',array('class'=>'control-label'));
            echo CHtml::textField('IeltseyeSpeakingTopicCard[questions]['.$key.']', $question, array('class'=>'span8','maxlength'=>255));            
        }
    ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Create',
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