<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'coffee-article-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->dropDownListRow($model, 'catid', $model->getCategorys()); ?>

	<?php echo $form->textFieldRow($model,'displayorder',array('class'=>'span5','maxlength'=>255)); ?>	

	<?php echo $form->textFieldRow($model,'source',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php if(!empty($model->filepath)):?>
        <?php echo CHtml::label('图片预览', 'image', array('class'=>''));?>
        <a href="<?php echo Yii::app()->params['site']."/images/upload/coffee/article/".$model->filepath;?>" class="lightbox">
            <img width="50%" class="img-polaroid" src="<?php echo Yii::app()->params['site']."/images/upload/coffee/article/".$model->filepath;?>" />
        </a>
    <?php endif;?>
    <?php if (!$model->isNewRecord){
        echo CHtml::label('删除附件', 'CoffeeArticle[del_image]', array('class'=>'label label-important'));
        echo CHtml::checkBox('CoffeeArticle[del_image]', false ,array('class'=>'span5'));
    }?>
    <?php echo $form->fileFieldRow($model, 'image'); ?>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->