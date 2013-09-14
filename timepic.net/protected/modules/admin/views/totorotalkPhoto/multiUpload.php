<?php
$this->breadcrumbs=array(
	'Totorotalk 热图'=>'admin',
	'批量上传',
);

$this->menu=array(
	array('label'=>'管理','url'=>array('admin'), 'active'=>true),
);
?>

<h1>批量上传龙猫图片</h1>

    <?php
    $this->widget( 'xupload.XUpload', array(
        'url' => Yii::app( )->createUrl( "/admin/totorotalkPhoto/upload"),
        //our XUploadForm
        'model' => $photos,
        //We set this for the widget to be able to target our own form
        'htmlOptions' => array('id'=>'totorotalk-photos-form'),
        'attribute' => 'file',
        'multiple' => true,
        'formView' => 'application.modules.admin.views.totorotalkPhoto._multiUploadform',
        )    
    );
    ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'primary',
        'label'=>'确认',
        'url'=>  Yii::app()->createUrl('admin/totorotalkPhoto/readyUpload')
    )); ?>

