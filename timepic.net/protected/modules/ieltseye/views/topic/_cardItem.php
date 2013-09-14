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

<!--search-->
<div class="row-fluid">
    <div class="span4">
        <?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'oralTopicSearch',
            'enableAjaxValidation'=>false,
            'method'=>'get',
        )); ?>

        <?php echo CHtml::textField('keyword', CHtml::encode($keyword), array('class'=>'input-media search-query')); ?>
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
        <?php if(!empty($dataProvider->data)): ?>
          <?php  foreach ($dataProvider->data as $item):?>
            <div class="topicCard">
                <div class="part"><?php echo "Part ".$item['type']?></div>
                <legend>
                    <?php 
                        $question = str_ireplace($keyword, '<span class="alert alert-info ieltsKeyword">'.$keyword.'</span>', CHtml::encode($item['question']));
//                        //replace tags
                        $question = IeltseyeHelper::textToTags($question);
                        echo $question;
                    ?>
                </legend>
                <?php if($item['type'] == 2):?>
                    <p>You should say:</p>
                    <div class="description">
                        <?php 
                            echo TimePicCode::TpCode($item['description']);
                        ?>
                    </div>
                <?php endif;?>
                <?php if(isset($item['tags']) && !empty($item['tags'])):?>
                    <p>Tags: <?php echo IeltseyeHelper::formatTags($item['tags'], 1);?></p>
                <?php endif;?>
                <p><a class="btn btn-primary btn-small" title="<?php echo CHtml::encode($item['question'])."-Answers-雅思口语答案";?>" href="<?php echo $this->createUrl("/sample/speakingTopic", array('id'=>$item['cardid']));?>">Answers</a></p>
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
<div class="pagination">
          <?php $this->widget('application.components.widgets.TpPager', 
              array('pages'=>$dataProvider->pagination,
                    'maxButtonCount'=>'6',
                )
            );?>
</div>