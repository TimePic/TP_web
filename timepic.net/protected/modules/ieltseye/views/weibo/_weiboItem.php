<?php
$keyword = isset($data['keyword']) ? $data['keyword'] : '';

?>
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
            'action' => '/weibo/search',
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
        <a class="btn btn-primary" href="" onclick="javascript:window.location.reload();">Refresh</a>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <?php if(isset($data['weibos'])): ?>
          <?php  foreach ($data['weibos'] as $item):?>
            <div class="well well-small">
                <div class="row-fluid">
                    <a href="http://weibo.com/u/<?php echo $item['uid'];?>" target="_blank">
                        <?php echo CHtml::encode($item['screen_name']);?>
                    </a>
                </div>
                <div class="row-fluid">
                    <p>
                        <?php echo IeltseyeHelper::textToTags($item['text']);?>
                    </p>
                    <p class="muted">
                        <span time="<?php echo CHtml::encode($item['created_at']);?>"><?php echo date('Y-m-d H:i:s', CHtml::encode($item['created_at']));?></span>
                    </p>
                </div>
            </div>
          <?php endforeach;?>
        <?php else: ?>
            <div class="well well-large">
                <div class="alert alert-error">
                  哦呦,貌似还木有微博，刷新试试...
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row-fluid">
    
    <div class="span4">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'oralTopicSearch',
            'action' => '/weibo/search',
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
        <a class="btn btn-primary" href="<?php echo Yii::app()->params['ieltseye']['homeUrl'];?>">Refresh</a>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="pagination">
          <?php $this->widget('application.components.widgets.TpPager', 
              array('pages'=>$data['pages'],
                    'maxButtonCount'=>'6',
                )
        );?>
</div>
<script type="text/javascript">
    $('span[time]').each(function(){
        var date = jsDateDiff($(this).attr('time'));
        $(this).text(date);
    });
</script>