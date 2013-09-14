<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery.lightbox.js"); ?>
<?php //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/common.js"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/lightbox.css"); ?>
<?php Yii::app()->clientScript->registerScriptFile("http://v3.jiathis.com/code/jia.js", CClientScript::POS_END); ?>
<?php
Yii::app()->clientScript->registerScript('totoropic_lightbox', "$('a.lightbox').lightBox();", CClientScript::POS_READY);
?>
<?php
$this->breadcrumbs = array(
    'Totoro Pic',
);
?>

<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links' => array(Yii::t('Base', 'totoroPicmenu') => Yii::app()->createUrl('/totoroPic'), '龙猫图片'),
));
?>

<div class="row-fluid">
    <div class="span8 pull-right">
        <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style pull-right">
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_fb"></a>
            <a class="jiathis_button_twitter"></a>
            <a class="jiathis_button_googleplus"></a>
            <a class="jiathis_button_douban"></a>
            <a class="jiathis_button_kaixin001"></a>
            <a class="jiathis_button_tieba"></a>
            <a class="jiathis_button_renren"></a>
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_mop"></a>
            <a class="jiathis_button_miliao"></a>
            <a class="jiathis_button_tsohu"></a>
            <a class="jiathis_button_t163"></a>
            <a class="jiathis_button_fav"></a>
            <a class="jiathis_button_copy"></a>
        </div>
    </div>
</div>
<div class="row-fluid" >
    <div class="span2">
<?php if ($preid): ?>
            <a href="<?php echo Yii::app()->createUrl('totoroPic/view/' . $preid) ?>" class="changePhoto pull-left">‹</a>
<?php endif; ?>
    </div>
    <div class="span8">
        <img class="img-rounded" src="<?php echo CommonHelper::getImageByType($currentPic['filepath'], "totorotalk", "big", 'url', 1); ?>" alt="totoropic" />
    </div>
    <div class="span2">
<?php if ($nextid): ?>
            <a href="<?php echo Yii::app()->createUrl('totoroPic/view/' . $nextid) ?>" class="changePhoto pull-right">›</a>
<?php endif; ?>
    </div>
</div>


<div class="row-fluid show_nave">
    <div class="span2 offset5">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'ajaxButton',
            'htmlOptions' => array('id' => 'likeButton'),
            'encodeLabel' => false,
            'label' => 'like <span id="liketimes">' . $currentPic['liketimes'] . '</span>',
            'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'large', // null, 'large', 'small' or 'mini'
            'icon' => 'icon-heart icon-white',
            'url' => Yii::app()->createUrl('totoroPic/like/' . $currentid),
            'ajaxOptions' => array('success' => 'js:function(data){$("#liketimes").html(parseInt($("#liketimes").html())+1);$("#likeButton").attr("disabled","disabled")}'),
        ));
        ?>
    </div>
    <div class="span4 pull-right">
        <i class="icon-eye-open"></i> <?php echo $currentPic['views'] ?>&nbsp;
        <i class="icon-time"></i> <?php echo date('Y-m-d H:i:s', $currentPic['dateline']); ?>
    </div>
</div>

<div class="row-fluid well show_nave">
    <h4>相关龙猫图</h4>
<?php if ($relatePic) : ?>
        <ul class="thumbnails">
            <?php foreach ($relatePic as $photo): ?>
                <li class="span2">
                    <a href="<?php echo Yii::app()->createUrl('totoroPic/view/' . $photo['pid']) ?>" class="thumbnail noborder">
                        <img class="img-polaroid" src="<?php echo CommonHelper::getImageByType($photo['filepath'], "totorotalk", "thumb", 'url', 1); ?>" alt="">
                    </a>
                </li>	
    <?php endforeach; ?>
        </ul>


<?php else: ?>
        <div class="alert alert-success">
            嘿！你真棒，全部的图片都已经看完了。赶紧使用龙猫语言翻译器上传新的图片吧。
        </div>
<?php endif; ?>
</div>
<div class="row-fluid well show_nave">
    <script type="text/javascript">
        (function(){
            var url = "http://widget.weibo.com/distribution/comments.php?width=0&url=auto&color=cccccc,ffffff,4c4c4c,5093d5,cccccc,f0f0f0&colordiy=1&ralateuid=2734978073&appkey=3706708774&dpc=1";
            url = url.replace("url=auto", "url=" + document.URL); 
            document.write('<iframe id="WBCommentFrame" src="' + url + '" scrolling="no" frameborder="0" style="width:100%"></iframe>');
        })();
    </script>
    <script src="http://tjs.sjs.sinajs.cn/open/widget/js/widget/comment.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        window.WBComment.init({
            "id": "WBCommentFrame"
        });
    </script>
</div>

<script type="text/javascript" >
    var jiathis_config={
        url:location.href,
        summary:"<?php echo Yii::t('Base', 'TotoroTalk_App_caption'); ?>",
        title:"#<?php echo Yii::t('Base', 'ShareTotorotalk'); ?>#",
        pic:"<?php echo CommonHelper::getImageByType($currentPic['filepath'], "big", 'url', 1); ?>",
        ralateuid:{
            "tsina":"2734978073"
        },
        appkey:{
            "tsina":"3706708774"
        },
        hideMore:true
    }
</script>