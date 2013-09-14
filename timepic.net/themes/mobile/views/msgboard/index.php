<?php
$this->breadcrumbs=array(
	'Msgboard',
);?>
<div class="row-fluid">
	<div class="span4 well">
		<?php echo Yii::t('Base','Leave us a message');?>
	</div>
	<div class="span7">
		<div class="row-fluid">
			<?php /** @var TbActiveForm $form */
			$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id'=>'msgboard',
				'enableAjaxValidation'=>false,
				'type'=>'verticalForm',
				'enableClientValidation'=>true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
				'focus' => array($model, 'email'),
				'htmlOptions'=>array('class'=>'well'),
			));
			?>
				<fieldset>
					<legend><?php echo Yii::t('Base','Message');?></legend>
					<?php //echo $form->error($model,'',array(), false); ?>
					<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3', 'value'=>Yii::t('Base','Anonymous')));?>
					<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3', 'icon'=>'envelope')); ?>
					<?php echo $form->textAreaRow($model, 'content', array('class'=>'span4', 'rows'=>5)); ?>
					<?php echo $form->labelEx($model,'appid')?>
					<?php echo CHtml::activeRadioButtonList($model, 'appid', array('1'=>Yii::t('Base','Wallpaper'),'2'=>Yii::t('Base','totorotalk')), array('template'=>'<label class="radio inline">{input}{label}</label>','separator'=>'')); ?>
					<?php echo $form->error($model,'appid',array()); ?>
					<?php echo CHtml::hiddenField('Msgboard[status]', '1'); ?>
				</fieldset>

			<div class="row-fluid">
					<?php echo CHtml::activeTextField($model, 'verifyCode', array('class'=>'input-small')); 
					?>
					<?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>Yii::t('Base','Click'),'title'=>Yii::t('Base','Click'),'style'=>'cursor:pointer'))); ?>
					<?php echo $form->error($model,'verifyCode',array()); ?>
			</div>
			<div class="form-actions">
					<?php //echo CHtml::ajaxSubmitButton('ok', array(), array('class'=>'span3'))?>
					<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
					<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
				</div>
			<?php $this->endWidget(); ?>
		</div>

	  <?php  foreach ($msgs as $msg):?>
		<div class="row well">
			<blockquote class="span6">
				<p class="inline wordwrap"><?php echo CHtml::encode($msg['content']);?></p>
				<small class="pull-right">
					<?php echo CHtml::encode($msg['username']);?> 
					<cite title=""><?php echo CommonHelper::sgmdate('Y-m-d H:i:s', CHtml::encode($msg['dateline']), 1)?></cite>
				</small>
			</blockquote>

		</div>
	  <?php endforeach;?>
	  <?php $this->widget('bootstrap.widgets.TbPager', 
			  array('pages'=>$pages,
				  'htmlOptions'=>array('class'=>'pagination'),
				)
		);?>
	</div>
</div>