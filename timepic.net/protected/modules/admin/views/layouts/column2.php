<?php $this->beginContent('/layouts/main'); ?>
<?php
	function adminSideMenu($uri,$right=FALSE){
		$adminSideMenu = array(
			'/admin' => array('label'=>'主页', 'url'=>'/admin'),
			array('label'=>'Totorotalk'),
			'/admin/totorotalkArticle/admin' => array('label'=>'Totorotalk百科',  'url'=>'/admin/totorotalkArticle/admin'),
			'/admin/totorotalkPhoto/admin' => array('label'=>'Totorotalk热图',  'url'=>'/admin/totorotalkPhoto/admin'),
			'/admin/totorotalkCategory/admin' => array('label'=>'Totorotalk百科分类',  'url'=>'/admin/totorotalkCategory/admin'),
			'/admin/totoroVideo/admin' => array('label'=>'龙猫视频',  'url'=>'/admin/totoroVideo/admin'),
			array('label'=>'TimePic 网站'),
			'/admin/msgboard' => array('label'=>'用户留言板',  'url'=>'/admin/msgboard'),
			array('label'=>'TimePic Coffee'),
			'/admin/coffeeArticle/admin' => array('label'=>'咖啡教程',  'url'=>'/admin/coffeeArticle/admin'),
			array('label'=>'IELTS EYE'),
            '/admin/ieltseyeWeibo/admin' => array('label'=>'Weibo',  'url'=>'/admin/ieltseyeWeibo/admin'),
            '/admin/ieltseyeTag/admin' => array('label'=>'Topic Tag',  'url'=>'/admin/ieltseyeTag/admin'),
			'/admin/ieltseyeSpeakingTopicCard/admin' => array('label'=>'Topic Cards',  'url'=>'/admin/ieltseyeSpeakingTopicCard/admin'),
            '/admin/ieltseyeSpeakingTopicSample/admin' => array('label'=>'Topic Samples',  'url'=>'/admin/ieltseyeSpeakingTopicSample/admin'),
		);	
		if ($adminSideMenu[$uri]) {
			$adminSideMenu[$uri]['active'] = true;
			return $adminSideMenu;
		}	

		return $adminSideMenu;
	}
?>

<div class="row-fluid">
		<div id="sidebar" class="span2">
			<div class="subnav">
				<?php $this->widget('bootstrap.widgets.TbMenu', array(
					'type'=>'list',
					'items'=>adminSideMenu(Yii::app()->request->requestUri),
                    'htmlOptions'=>array('class'=>'well affix')
				)); ?>
			</div>
		</div>
			<!-- sidebar -->
        <div class="span10">
                    <?php echo $content; ?>
        </div>
	</div>
</div>
<?php $this->endContent(); ?>