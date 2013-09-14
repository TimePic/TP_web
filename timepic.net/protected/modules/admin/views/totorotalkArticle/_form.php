<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'totorotalk-article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'thumbimg',array('class'=>'span5','maxlength'=>255)); ?>
	
	<?php echo $form->textFieldRow($model,'displayorder',array('class'=>'span1','maxlength'=>2)); ?>
	
	<?php echo $form->dropDownListRow($model, 'catid', TotorotalkCategory::getTotoroCategorys()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
