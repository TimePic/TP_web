<?php
$this->breadcrumbs=array(
	'Index',
);?>

<div class="row-fluid">

	<div class="span6">
		<div id="wallpaperlogo"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/common/logo.png"/></div>
		<div id="wallpaperintro" class="span6 caption">
			<?php echo Yii::t('Base','Wallpaper_App_caption_p');?>
		</div>
	</div>
	<div class="span6 ">
		<div id="wallpaperscreen"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/wallpaper/iphonescreen.png"/></div>
	</div>
</div>
<div class="row-fluid download">
    <?php $this->widget('application.components.widgets.TpAppdownloadWidget');?>
</div>