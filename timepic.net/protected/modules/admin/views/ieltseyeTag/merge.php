<?php
$this->breadcrumbs=array(
	'Ieltseye Tags'=>array('index'),
	'Merge',
);

$this->menu=array(
	array('label'=>'Manage IeltseyeTag','url'=>array('admin')),
);
?>

<h1>Merge IeltseyeTag</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ieltseye-speaking-topic-card-form',
    'focus'=>array($model,'fromTagid'),
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true
)); ?>

<div class="control-group">
    <div class="controls">
        <?php echo $form->textFieldRow($model,'fromTagid',array('class'=>'span6','maxlength'=>255)); ?>
        
    </div>
</div>

<div class="control-group">
    <p><i class="icon-arrow-down"></i>合并到</p>
</div>

<div class="control-group">
    <div class="controls">
        <?php echo $form->textFieldRow($model,'toTagid',array('class'=>'span6','maxlength'=>255)); ?>
    </div>
</div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Merge',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
