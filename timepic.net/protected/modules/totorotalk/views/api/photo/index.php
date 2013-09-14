<?php
$this->breadcrumbs=array(
	'Photo',
);?>
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'photo-form',
'enableAjaxValidation'=>false,
'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="row"">
<?php echo $form->labelEx($model,'totoroPhoto'); ?>
<?php echo CHtml::activeFileField($model,'totoroPhoto'); ?>
<?php echo $form->error($model,'totoroPhoto'); ?>
<?php echo CHtml::hiddenField("title", "aaa") ?>
</div>
<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<?php $this->endWidget(); ?>