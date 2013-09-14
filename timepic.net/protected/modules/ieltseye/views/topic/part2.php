<?php
$this->pageTitle = Yii::app()->params['ieltseye']['seoTitle']."-Topic-口语卡-Part2";
$this->breadcrumbs=array(
	'IELTS Speaking Topic'=>array('/topic'),
    'Part 2',
);
?>
<div class="row-fluid">
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Part1', 'url'=>array('/topic/part1')),
        array('label'=>'Part2', 'url'=>array('/topic/part2'),'active'=>true),
        array('label'=>'Part3', 'url'=>array('/topic/part3')),
    ),
)); ?>
</div>
<?php $this->renderpartial('_cardItem', array('dataProvider'=>$dataProvider, 'keyword'=>$keyword));?>