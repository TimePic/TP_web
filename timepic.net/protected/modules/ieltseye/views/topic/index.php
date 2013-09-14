<?php
$this->pageTitle = Yii::app()->params['ieltseye']['seoTitle']."-Topic-口语卡";
$this->breadcrumbs=array(
	'IELTS Speaking Topic'=>array('/topic'),
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
<?php if(!empty($keyword)):?>
<script type="text/javascript">
$(function () { 
    var count = 3;
    var countdown = setInterval(CountDown, 1000); 
    var btn = $("[name='topicSearch']");
    function CountDown() {
        btn.attr("disabled", true); 
        btn.text("wait " + count + "s!"); 
        if (count == 0) { 
            btn.text("Search").removeAttr("disabled"); 
            clearInterval(countdown); 
        } 
        count--; 
    }
})
</script> 
<?php endif;?>
<div class="row-fluid">
    
    <div class="span4">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'oralTopicSearch',
            'enableAjaxValidation'=>false,
            'method'=>'get',
        )); ?>

        <?php echo CHtml::textField('keyword', CHtml::encode($keyword), array('class'=>'input-small search-query')); ?>
        <?php 
        $htmlOptionsArr = !empty($keyword) ? array('name'=>'topicSearch','disabled'=>'true') : array('name'=>'topicSearch');
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'btn',
            'label'=>'Search',
            'htmlOptions' =>$htmlOptionsArr,
        )); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <?php if(isset($data)): ?>
          <?php  foreach ($data as $item):?>
            <div class="topicCard">
                <legend><?php echo $item['question'];?></legend>
                <?php if($item['type'] == 2):?>
                    <p>You should say:</p>
                    <div class="description">
                        <?php echo $item['description'];?>
                    </div>
                <?php endif;?>
                    <p><a class="btn btn-primary btn-small" href="<?php echo $this->createUrl("/sample/speakingTopic", array('id'=>$item['cardid']));?>">Samples</a></p>
            </div>
          <?php endforeach;?>
        <?php else: ?>
            <div class="well well-large">
                <div class="alert alert-error">
                  哦呦,貌似还木有这样的答题卡
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="pagination">
          <?php $this->widget('application.components.widgets.TpPager', 
              array('pages'=>$pages,
                    'maxButtonCount'=>'6',
                )
        );?>
</div>