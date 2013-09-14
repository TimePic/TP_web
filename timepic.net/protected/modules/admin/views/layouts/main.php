<!DOCTYPE HTML>
<html lang="en" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh-CN" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/css/admin.css" />
	<?php Yii::app()->bootstrap->register(); ?>
</head>
    
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.lightbox.js");?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/lightbox.css");?>
<?php
Yii::app()->clientScript->registerScript('admin_lightbox',"$('a.lightbox').lightBox();", CClientScript::POS_READY);
?>
<body>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'fixed'=>'top',
    'type'=>'inverse',
    'brand'=>'TimePic',
    'brandUrl'=>Yii::app()->createUrl('/admin/index'),
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'管理主页', 'url'=>array('/admin')),
                array('label'=>'TimePic主页', 'url'=>'/','linkOptions'=>array('target'=>'_blank')),
                array('label'=>'Totorotalk百科', 'url'=>array('/admin/totorotalkArticle')),
                array('label'=>'登陆', 'url'=>array('.admin/member/login'), 'visible'=>Yii::app()->user->isGuest),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'退出 ('.Yii::app()->user->username.')', 'url'=>array('/admin/member/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); 
?>
<div class="container" id="page">
    <div class="row-fluid">
        <div id="header">		
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink'=>  CHtml::link('TimePic后台', '/admin/'),
                    'links'=>$this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            <?php endif?>
                <!--menu-->
            <div class="offset2">
                <?php if(isset($this->menu)):?>
                    <?php $this->widget('bootstrap.widgets.TbMenu', array(
                        'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
                        'stacked'=>false, // whether this is a stacked menu
                        'items'=>$this->menu
                    ));?>
                <?php endif?>
            </div>
        </div><!-- header -->


        <?php echo $content; ?>

        <div class="clear"></div>

        <div id="footer">
            Copyright &copy; <?php echo date('Y'); ?> by My TimePic.<br/>
            All Rights Reserved.<br/>
        </div><!-- footer -->
    </div>

</div><!-- page -->

</body>
</html>