<div class="row-fluid">
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('龙猫市场'=>array('index'), '创建龙猫交易'),
)); 
$this->pageTitle .= "-创建龙猫交易";
?>
    
</div>
<div class="row-fluid">
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'龙猫市场', 'url'=>array('index')),
        array('label'=>'创建龙猫交易', 'url'=>array('create'), 'active'=>true),
        array('label'=>'我的龙猫市场', 'url'=>array('admin')),
    ),
    'htmlOptions'=>array('class'=> 'pull-right'),
)); ?>
</div>
<h1>分享龙猫信息</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>