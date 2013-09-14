<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh-CN" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/style.css"/>
	<?php Yii::app()->bootstrap->register(); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/google.js",CClientScript::POS_END); ?>
</head>

<body>
<?php if(!CommonHelper::checkmobile()):?>
<div class="row-fluid">
	<div id="cloud1" class="clouds">
		<div id="clouds_small"></div>
	</div>
	<div id="cloud_front" class="clouds">
		<div id="clouds_big"></div>
	</div>
</div><!-- end clouds -->
<?php endif;?>

<?php

//memberinfo
$memberInfo = array();
if (!Yii::app()->user->isGuest && isset(Yii::app()->user->username)) {
        $adminLogin = isset (Yii::app()->user->adminid) ? '<li><a href="/admin/member/login">'."登陆后台".'</a></li>': '';
        $memberInfo = '<ul class="nav pull-right">
                         <li class="dropdown">
                                <a href="#" class="userInfo dropdown-toggle" data-toggle="dropdown">
                                        <img class="avatar" src="'.Yii::app()->user->avatar.'"/>  <span class="nc">'.Yii::app()->user->username.'</span>
                                        <b class="caret"></b>
                                </a>

                                <ul class="dropdown-menu">
                                        '.$adminLogin.'
                                        <li><a href="'.Yii::app()->createUrl('chinchilla/market/admin/').'">我的龙猫</a></li>
                                        <li><a href="/TPUser/logout">'.Yii::t('Base', 'Logout').'</a></li>
                                </ul>
                         </li>
                         
                       </ul>';
} else {
        $sinaLoginUrl = CommonHelper::getOpenIdUrl(1);
        $memberInfo = '<ul class="nav pull-right"><li><a href="'.$sinaLoginUrl.'"><img src="'.Yii::app()->request->getBaseUrl(true).'/images/static/common/sina_16.png"/>  '.Yii::t('Base', 'Login').'</a></li></ul>';
}

$this->widget('bootstrap.widgets.TbNavbar', array(
    'fixed' => 'top',
    'type' => 'inverse',
    'brand' => 'TimePic',
    'brandUrl' => Yii::app()->params['site'],
    'collapse' => true, // requires bootstrap-responsive.css
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => CommonHelper::TimePicMenu(Yii::app()->request->requestUri),
        ),
        $memberInfo,
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'htmlOptions' => array('class' => 'pull-right'),
            'items' => CommonHelper::TimePicMenu(Yii::app()->request->requestUri, true),
        ),
        
    ),
));
?>

<div id="container" class="container">
	<header></header>
	
	<?php echo $content; ?>
	<div class="clear"></div>

</div><!-- page -->

<footer id="footer" class="footer">
    <div class="container">
        <!-- <p>Copyright &copy; <?php echo date('Y'); ?> TimePic. All Rights Reserved.</p> -->
        <address>
            <strong><?php echo Yii::t('Base','Contact Us');?> </strong><br>
            <a href="mailto:#">timepic.net@gmail.com</a>
        </address>                
    </div>
</footer><!-- footer -->
</body>
</html>
