<?php
$this->breadcrumbs=array(
	'Totorotalk Photos'=>array('index'),
	'确认上传文件',
);

$this->menu=array(
	array('label'=>'List TotorotalkPhoto','url'=>array('index')),
	array('label'=>'Manage TotorotalkPhoto','url'=>array('admin')),
);
?>
<h1>确认上传的图片</h1>
<?php if(!empty($photos)):?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'totorotalk-readyUpload-form',
	'enableAjaxValidation'=>false,
)); ?>
    <table class="items table-hover" width="100%">
        <thead><tr><td>Id</td><td>缩略图</td><td>标题</td><td>大小(k)</td><td>类型</td><td>尺寸</td><td>操作</td></tr></thead>
        <tbody>
            <?php $i=1; foreach($photos as $key => $photo):?>
                <tr>
                    <td>
                        <?php echo $i;$i++;?>
                    </td>
                    <td>
                        <a href="<?php echo $photo['url'];?>" class="lightbox">
                            <?php echo CHtml::image($photo['thumbnail_url'], $photo['filename'], array('class'=>'img-rounded', 'title'=>$photo['filename']))?>
                        </a>
                    </td>
                    <td>
                        <?php echo CHtml::textField('totorotalkReadyUpload['.$photo['filename'].']','totoroPhoto_web');?>
                    </td>
                    
                    <td>
                        <?php echo CHtml::encode(round($photo['size']/1024, 2));?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($photo['mime']);?>
                    </td>
                    <td>
                        <?php echo CHtml::encode($photo['width']).'*'.CHtml::encode($photo['heigh']);?>
                    </td>
                    <td>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'ajaxLink',
                            'type'=>'danger',
                            'label'=>'删除',
                            'url'=>Yii::app()->createUrl('admin/totorotalkPhoto/uploadDelete', array('id'=>$photo['filename'])),
							'ajaxOptions'=>array('update'=>'#totorotalk-readyUpload-form'),
                        )); ?>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'确认上传',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
<?php else:?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'primary',
        'label'=>'还没有上传任何图片,点击返回',
        'url'=>  Yii::app()->createUrl('admin/totorotalkPhoto/multiUpload')
    )); ?>
<?php endif;?>

<script type="text/javascript">
function delImage(){
    var warning = '你确定要删除该图片吗？该操作不可恢复！';
    if (!confirm(warning)) {
		return false;
	}
	alert('1111');
	
}
</script>