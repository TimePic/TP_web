<?php Yii::app()->clientScript->registerScriptFile("http://v3.jiathis.com/code/jia.js", CClientScript::POS_END);?>
<?php
$this->breadcrumbs=array(
	'Totoro Pic',
);?>

<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array(Yii::t('Base','totoroPicmenu')),
)); ?>


<div class="row-fluid">
    <?php $this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
    'pager'=>array('class'=>'application.components.widgets.TpPager'),
    'itemView'=>'_thumb',
    'ajaxUpdate'=>false,
)); ?>
</div>

<script type="text/javascript" >
var jiathis_config={
    url:location.href,
    summary:"<?php echo Yii::t('Base','TotoroTalk_App_caption');?>",
    title:"<?php echo Yii::t('Base','ShareTotorotalk');?>",
    pic:"",
    ralateuid:{
        "tsina":"2734978073"
    },
    appkey:{
        "tsina":"3706708774"
    },
    hideMore:true
}
</script>