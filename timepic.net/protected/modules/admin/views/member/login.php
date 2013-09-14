<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'admin/Login',
);
?>

<h1>登陆</h1>

<p>欢迎煎蛋和焦糖的好麻麻:</p>

<div class="form">
<?php /** @var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'login-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
<div class="row-fluid">
	<?php echo $form->textField($model,'verifyCode' ,array('class'=>'input-small')); ?>
	<?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>Yii::t('Base','Click'),'title'=>Yii::t('Base','Click'),'style'=>'cursor:pointer'))); ?>
	<?php echo $form->error($model,'verifyCode'); ?>
</div>
<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Login')); ?>
 
<?php $this->endWidget(); ?>
</div><!-- form -->