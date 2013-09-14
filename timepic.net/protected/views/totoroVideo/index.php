<?php
/* @var $this TotoroVideoControllerController */

$this->breadcrumbs=array(
	'Totoro Video',
);
?>
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array(Yii::t('Base','totoroVideo')),
)); ?>
<div class="row-fluid">
	<ul class="thumbnails">
	<?php foreach ($videos as $video):?>
	<li class="span3" style="margin-left:10px;">
			<div class="thumbnail">
				<a href="#" rel="tooltip" title="<?php echo  $video['title'];?>" style="display: block;">
				<img style="width:256px;height:160px;" src="<?php echo $video['img'];?>" alt="<?php echo $video['title'];?>" data-toggle="modal" data-target="#vid_<?php echo $video['vid']?>" />
				</a>

				<h6 class="well">
					<a href="#vid_<?php echo $video['vid']?>" role="button" class="btn btn-primary btn-small" data-toggle="modal">
						<i class="icon-play-circle icon-white"></i>
					</a>
					<?php echo  CommonHelper::cutstr($video['title'], 18);?>
				</h6>
				<!-- Button to trigger modal -->


				<!-- Modal -->
				<div id="vid_<?php echo $video['vid']?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel_<?php echo $video['vid']?>" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="ModalLabel_<?php echo $video['vid']?>"><?php echo $video['title']?></h3>
					</div>
					<div class="modal-body">
						<p><?php echo $video['html']?></p>
					</div>
				</div>
			</div>
	</li>
		
	<?php endforeach;?>
	</ul>
</div>
<div class="pagination">  
	<?php  

	$this->widget('application.components.widgets.TpPager',array(  
		'header'=>'',  
		'pages' => $pages,  
		'maxButtonCount'=>10  
		)  
	);  
	?>  
</div>  
