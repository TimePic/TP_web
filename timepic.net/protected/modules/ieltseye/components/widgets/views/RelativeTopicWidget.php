<div class="relative">
    <h4>Relative Topics</h4>
    <?php if($data):?>
        <ul class="unstyled topic">
          <?php foreach($data as $item):?>
            <li><span class="label label-info">Part <?php echo $item['type'];?> </span>  <?php echo CHtml::link(CHtml::encode($item['question']), Yii::app()->createUrl('/sample/speakingTopic/', array('id'=>$item['cardid'])), array('target'=>'_blank'));?></li>
          <?php endforeach;?>
        </ul>
    <?php else:?>
        <div class="alert alert-error">
          No relative topic.
        </div>
    <?php endif;?>
</div>