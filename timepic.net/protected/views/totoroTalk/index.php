<?php
$this->breadcrumbs=array(
	'Index',
);?>
<div class="row-fluid">
	<div class="lside span6">
		<div id="totorologo">
			<img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorotalk/logo.png"/>
		</div>
		<div id="totorointro">
			<div class="caption">
				<?php echo Yii::t('Base','TotoroTalk_App_caption');?>
			</div>
		</div>
	</div>
	<div class="span6">
		<div id="totoroscreen"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorotalk/iphonescreen.png"/></div>
	</div>
</div>
<div class="row-fluid download">
    <?php $this->widget('application.components.widgets.TpAppdownloadWidget');?>
</div>