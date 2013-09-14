<?php
$this->breadcrumbs=array(
	'首页',
);?>
<div class="row-fluid indexCarousel">
	<?php $this->widget('bootstrap.widgets.TbCarousel', array(
    'items'=>array(
        
		array('image'=>'/images/static/common/us.png',
			'label'=>Yii::t('Base','About TimePic'),
			'caption'=>Yii::t('Base','About_us_caption')),
		
		array('image'=>'/images/static/common/app1.png',
			'label'=>Yii::t('Base','Wallpaper'),
			'caption'=>Yii::t('Base','Wallpaper_App_caption')),
        
		array('image'=>'/images/static/common/app2.png',
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
	<?php $this->widget('application.components.widgets.TpAppdownloadWidget');?>
</div>