<?php echo CHtml::openTag('div', $htmlOptions)?>
<?php
list($widgetController, $widgetAction) = Yii::app()->createController('api/Comment/');
?>
	<div class="row">
		<?php 
			$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id'=>'commentForm',
				'enableAjaxValidation'=>false,
				'type'=>'verticalForm',
				'enableClientValidation'=>true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
					'afterValidate'=>'js:formSend',
				),
				'htmlOptions'=>array('class'=>'well'),
				'focus'=>array($model,'email'),
				
			));
		?>
		<div class="form-actions">
			<fieldset>
				<legend><?php echo Yii::t('Base','Message');?></legend>
				<?php echo $form->textFieldRow($model, 'author', array('class'=>'span6', 'value'=>Yii::t('Base','Anonymous')));?>
				<?php echo $form->textFieldRow($model, 'email', array('class'=>'span6', 'icon'=>'envelope')); ?>
				<?php echo $form->textAreaRow($model, 'message', array('class'=>'span9', 'rows'=>5)); ?>
				<?php echo CHtml::hiddenField('Comment[id]', $id);?>
				<?php echo CHtml::hiddenField('Comment[idtype]', $idtype);?>
			</fieldset>
		</div>
		<div class="row-fluid">
				<?php echo CHtml::activeTextField($model, 'verifyCode', array('class'=>'input-small'));
				?>
				<?php $widgetController->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>Yii::t('Base','Click'),'title'=>Yii::t('Base','Click'),'style'=>'cursor:pointer'))); ?>
				<?php echo $form->error($model,'verifyCode',array()); ?>
		</div>
		<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit', 'htmlOptions'=>array('id'=>'commentsubmit'))); ?>
				<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
		</div>
		<?php $this->endWidget(); ?>
	</div>

	<?php  foreach ($msgs as $msg):?>
		<div class="row well">
			<blockquote>
				<p class="inline wordwrap"><?php echo CHtml::encode($msg['message']);?></p>
				<small class="pull-right">
					<?php echo CHtml::encode($msg['author']);?> 
					<cite title=""><?php echo CommonHelper::sgmdate('Y-m-d H:i:s', CHtml::encode($msg['dateline']), 1)?></cite>
				</small>
			</blockquote>
		</div>
	<?php endforeach;?>