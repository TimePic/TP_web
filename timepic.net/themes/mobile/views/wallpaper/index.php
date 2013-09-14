<?php
$this->breadcrumbs=array(
	'Index',
);?>

<div class="row-fluid">

	<div class="leftbar">
		<div id="wallpaperlogo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/static/common/logo.png"/></div>
		<div id="wallpaperintro" class="span2 caption">
			<?php echo Yii::t('Base','Wallpaper_App_caption_p');?>
		</div>
	</div>
	
	<div class="rightbar">
		<div id="wallpaperscreen"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/static/wallpaper/iphonescreen.png"/></div>
	</div>
</div>

<div class="row-fluid download">
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>  Yii::t('Base','Wallpaper'),
        'buttonType'=>'link',
        'icon'=>'icon-download-alt icon-white',
        'type'=>'primary',
        'url'=>'http://itunes.apple.com/cn/app/timepic-bi-zhi-wallpaper/id502370929?mt=8',
        'encodeLabel'=>false,
        'htmlOptions'=>array('target'=>'_blank', 'data-title'=>Yii::t('Base','Wallpaper'), 'data-content'=>Yii::t('Base','Wallpaper_App_caption'), 'rel'=>'popover', 'data-trigger'=>'hover'),
        )); ?>
    </div>
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('Base','totorotalk'),
        'buttonType'=>'link',
        'icon'=>'icon-download-alt icon-white',
        'type'=>'primary',
        'url'=>'http://itunes.apple.com/cn/app/timepic-hui-shuo-hua-long/id516541985?mt=8',
        'htmlOptions'=>array('target'=>'_blank', 'data-title'=>Yii::t('Base','totorotalk'), 'data-content'=>Yii::t('Base','TotoroTalk_App_caption'), 'rel'=>'popover', 'data-trigger'=>'hover'),
        )); ?>
    </div>
    <div class="span2">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('Base','totoroCrossCalculator'),
        'buttonType'=>'link',
        'icon'=>'icon-download-alt icon-white',
        'type'=>'primary',
        'url'=>'/totoroCrossCalculator',
        'htmlOptions'=>array('target'=>'_blank', 'data-title'=>Yii::t('Base','totoroCrossCalculator'), 'data-content'=>Yii::t('Base','totoroCrossCalculator'), 'rel'=>'popover', 'data-trigger'=>'hover'),
        )); ?>
    </div>
</div>
