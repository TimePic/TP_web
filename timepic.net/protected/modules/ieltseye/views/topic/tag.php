<?php
$this->pageTitle = Yii::app()->params['ieltseye']['seoTitle']."-Topic-口语卡-Tag-".$keyword;
$this->breadcrumbs=array(
	'IELTS Speaking Topic'=>array('/topic'),
    'Tag:'.$keyword,
);
?>
<div class="row-fluid">
    <?php 
        $tagsCache = IeltseyeCache::loadCache('Tags');
        if (!empty($tagsCache)) {

            foreach ($tagsCache as $tag) {
                $tagsarray[$tag['tagname']] = $tag['tagid'];
                $typeAheadData[] = $tag['tagname'];
                if ($tag['aliasWords']) {
                    $aliasWords = explode(',', $tag['aliasWords']);
                    if ($aliasWords) {
                        foreach ($aliasWords as $aliasWord) {
                            $tagsarray[$aliasWord] = $tag['tagid'];
                            $typeAheadData[] = $aliasWord;
                        }
                    }
                }
            }
        }
        $tagsData = json_encode($tagsarray);
    ?>
    <script type="text/javascript">
        var tags = <?php echo $tagsData;?>;
        function searchTag(){
            tagid = tags[$('#searchTag').val()];
            if (!tagid) {
                alert("Sorry, cannot find this tag.");
                return false;
            }else{
                window.location.href = "/topic/tag/"+tagid;
            }
        }
    </script>
    <p>
        <?php
            $this->widget('bootstrap.widgets.TbTypeahead', array(
                'name'=>'typeahead',
                'options'=>array(
                    'source'=>$typeAheadData,
                    'items'=>4,
                    'matcher'=>"js:function(item) {
                        return ~item.toLowerCase().indexOf(this.query.toLowerCase());
                    }",
                ),
                'htmlOptions'=>array('id'=>"searchTag"),
            ));
        ?>
        <button type="button" class="btn btn-primary" style="margin-bottom: 10px;" onclick="searchTag();">Search</button>
    </p>
</div>
<div class="row-fluid">
        <?php if(!empty($dataProvider->data)): ?>
          <?php  foreach ($dataProvider->data as $item):?>
            <div class="topicCard">
                <div class="part"><?php echo "Part ".$item['type']?></div>
                <legend><?php echo str_ireplace($keyword, '<span class="alert alert-info ieltsKeyword">'.$keyword.'</span>', CHtml::encode($item['question']));?></legend>
                <?php if($item['type'] == 2):?>
                    <p>You should say:</p>
                    <div class="description">
                        <?php echo TimePicCode::TpCode($item['description']);?>
                    </div>
                <?php endif;?>
                <?php if(isset($item['tags']) && !empty($item['tags'])):?>
                    <p>Tags: <?php echo IeltseyeHelper::formatTags($item['tags'], 1);?></p>
                <?php endif;?>
                <p><a class="btn btn-primary btn-small" title="<?php echo CHtml::encode($item['question'])."-Answers-雅思口语答案";?>" href="<?php echo $this->createUrl("/sample/speakingTopic", array('id'=>$item['cardid']));?>"">Answers</a></p>
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