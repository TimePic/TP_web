<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh-CN" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css"/>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
<div class="row-fluid">
	<div id="cloud1" class="clouds">
		<div id="clouds_small"></div>
	</div><!-- end clouds -->
	<div id="cloud_front" class="clouds">
		<div id="clouds_big"></div>
	</div>
</div><!-- end clouds -->
<script>
	var small_scrollSpeed = 10;
	var small_step = 1;
	var small_current = 0;
	var small_imageWidth = 218;
	var small_headerWidth = 940;   
	var small_restartPosition = -(small_imageWidth - small_headerWidth);
	var small_clouds = $('#clouds_small');
	
	function scrollBg(size){
		small_current -= small_step;
		if (small_current == small_restartPosition){
		  small_current = 0;
		}
		small_clouds.css("background-position",small_current+"px 0");
	}
//	init = setInterval("scrollBg('small')", small_scrollSpeed);//debug
	//var init_big = setInterval("scrollBg('big')", big_scrollSpeed);
</script>
<?php
	function TimePicMenu($uri,$right=FALSE){
		$TimePic_menu = array(
			'---',
			'/'=>array('label'=>Yii::t('Base','Home'), 'url'=>'/'),
			'---',
			'/wallpaper'=>array('label'=>Yii::t('Base','Wallpapermenu'), 'url'=>'/wallpaper'),
			'---',
			'totoro'=>array('label'=>Yii::t('Base','About Totoro'), 'url'=>'#', 'items'=>array(
				'/totoroTalk'=>array('label'=>Yii::t('Base','totorotalk'), 'url'=>'/totoroTalk'),
				'---',
				'/totoroCrossCalculator'=>array('label'=>Yii::t('Base','totoroCrossCalculator'), 'url'=>'/totoroCrossCalculator'),
				'---',	
				'/totoroPic'=>array('label'=>Yii::t('Base','totoroPicmenu'), 'url'=>'/totoroPic'),
				'---',	
				'/totoroVideo'=>array('label'=>Yii::t('Base','totoroVideo'), 'url'=>'/totoroVideo'),
				'---',	
			)),

		);
		
		$TimePic_menu_right = array(
			'---',
			'/Msgboard'=>array('label'=>Yii::t('Base','isue'), 'url'=>'/Msgboard'),
			'---',
			'zh_cn'=>array('label'=>Yii::t('Base','Chinese'), 'url'=>'?lang=zh_cn'),
			'---',
			'en'=>array('label'=>Yii::t('Base','English'), 'url'=>'?lang=en'),
			'---',
			'kr'=>array('label'=>Yii::t('Base','Korean'), 'url'=>'?lang=kr'),
			'---'
			
		);
		
		if (Yii::app()->language) {
			$TimePic_menu_right[Yii::app()->language]['active'] = true;
		}
		
		if ($right) {
			if ($TimePic_menu_right[$uri]) {
				$TimePic_menu_right[$uri]['active'] = true;

				return $TimePic_menu_right;
			}else{
				return $TimePic_menu_right;
			}
		}else{
		
			if ($TimePic_menu[$uri]) {
				$TimePic_menu[$uri]['active'] = true;
				return $TimePic_menu;
			}
			if ($TimePic_menu['totoro']['items'][$uri]) {
				$TimePic_menu['totoro']['active'] = true;
				return $TimePic_menu;
			}
		}

		return $TimePic_menu;
	}
?>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'fixed'=>'top',
    'type'=>'inverse',
    'brand'=>'TimePic',
    'brandUrl'=>Yii::app()->params['site'],
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>  TimePicMenu(Yii::app()->request->requestUri),
        ),
      array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>TimePicMenu(Yii::app()->request->requestUri,true),
        ),
    ),
)); ?>

<div id="container" class="container">
	
	<header >
		
	</header>
	
	<?php echo $content; ?>
	<div class="clear"></div>

</div><!-- page -->

<footer id="footer" class="footer">
    <div class="container">
        <p>Copyright &copy; <?php echo date('Y'); ?> TimePic. All Rights Reserved.</p>
        <address>
            <strong><?php echo Yii::t('Base','Contact Us');?> </strong><br>
            <a href="mailto:#">timepic.net@gmail.com</a>
        </address>                
    </div>
</footer><!-- footer -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30636024-1']);
  _gaq.push(['_setDomainName', 'timepic.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript"> 
if (top.location !== self.location) { 
top.location=self.location; 
} 
</script> 

</body>
</html>
