<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh-CN" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->bootstrap->register(); ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/ieltseye.css"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/ieltseyeCore.js"); ?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/ieltseye.js",CClientScript::POS_END); ?>
</head>
<body>
<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed' => false,
    'fluid'=> false,
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>Yii::app()->params['ieltseye']['homeUrl']),
                array('label'=>'Topic', 'url'=>array('/topic/part2')),
                array('label'=>'Tag', 'url'=>array('/tag')),
            ),
        ),
    ),
)); ?>
<div class="container" id="page">
    <div class="row-fluid" id="header">
        <div class="alert">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>友情提醒!</strong> 
          <p>雅思口语回忆，请新浪微博<?php echo CHtml::link('@雅思口语网蹲哥', Yii::app()->params['ieltseye']['adminWeibo'])?></p>
          <p>下载：<?php echo CHtml::link('Android', Yii::app()->params['ieltseye']['appdownload']['android']);?>版 
              <?php if(!CommonHelper::checkmobile()):?>
                    <!--下载按钮开始-->
                    <a title="使用360手机助手安装" href="zhushou360://type=apk&name=雅思口语网蹲哥&icon=http://p2.qhimg.com/t01a746d814c3a53a4c.png&url=<?php echo Yii::app()->params['ieltseye']['appdownload']['android'];?>"><img alt="使用360手机助手安装" src="http://p3.qhimg.com/t01943097a6b50d1e96.png"></a>
                    <!--下载按钮结束-->
                    <!--请把这段代码放在页面最底部加载-->
                    <?php Yii::app()->clientScript->registerScriptFile("http://zhushou.360.cn/script/360mobilemgrdownload.js",CClientScript::POS_END); ?>
                    <!--代码结束-->
              <?php endif;?>
          </p>
        </div>    

    </div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'homeLink'=>  CHtml::link('Home', Yii::app()->params['ieltseye']['homeUrl']),
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
    
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
        <div class="gad">
            <?php $this->renderPartial('application.modules.ieltseye.views.public.gad');?>
        </div>
        <p id="back-to-top"><a href="#top">TOP</a></p>
        <p>
            Copyright &copy; <?php echo date('Y'); ?> by IELTSEYE. All Rights Reserved.  <a href="/about" target="_blank">用前必读</a><br/>
        </p>
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>
