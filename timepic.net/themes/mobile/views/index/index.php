<?php
$this->breadcrumbs=array(
	'首页',
);?>
<div class="row-fluid">
	<?php $this->widget('bootstrap.widgets.TbCarousel', array(
    'items'=>array(
        
		array('image'=>Yii::app()->theme->baseUrl.'/images/static/common/us.png',
			'label'=>Yii::t('Base','About TimePic'),
			'caption'=>Yii::t('Base','About_us_caption')),
		
		array('image'=>Yii::app()->theme->baseUrl.'/images/static/common/app1.png',
			'label'=>Yii::t('Base','Wallpaper'),
			'caption'=>Yii::t('Base','Wallpaper_App_caption')),
        
		array('image'=>Yii::app()->theme->baseUrl.'/images/static/common/app2.png',
			'label'=>Yii::t('Base','totorotalk'),
			'caption'=>Yii::t('Base','TotoroTalk_App_caption')),

    ),
    'events'=>array(
        'slide'=>"js:function() { console.log('Carousel slide.'); }",
        'slid'=>"js:function() { console.log('Carousel slid.'); }",
    ),
)); ?>
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