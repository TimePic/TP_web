<div class="row-fluid">
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('龙猫市场'=>array('index'), CommonHelper::cutstr($model->title, 30)),
)); 
$this->pageTitle .= "-".$model->title;
?>
</div>
<div class="row-fluid">
    <?php 
    if (Yii::app()->user->isGuest) {
        $tbMenu = array(
            array('label'=>'龙猫市场', 'url'=>array('index'),'active'=>true),
        );
    }else{
        $tbMenu = array(
            array('label'=>'龙猫市场', 'url'=>array('index'),'active'=>true),
            array('label'=>'创建龙猫交易', 'url'=>array('create')),
            array('label'=>'我的龙猫交易', 'url'=>array('admin')),
        );
    }
    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>$tbMenu,
    'htmlOptions'=>array('class'=> 'pull-right'),
    )); ?>
</div>
<div class="row-fluid">
    <a target='_blank' href='<?php echo Member::getMemberHomeUrl($model->author->openID, $model->author->openIDType);?>'>
        <img class="pull-left img-rounded" src="<?php echo $model->author->avatar;?>" style='margin:5px;'/>
    </a>
    <p><strong class='text-info'><?php echo $model->author->username;?></strong></p>
    <p><a target='_blank' href='<?php echo Member::getMemberHomeUrl($model->author->openID, $model->author->openIDType);?>'>>去他的微博</a></p>
</div>
<p class='text-left muted'><?php echo CHtml::encode(intval($model->views));?>人浏览>发表于：<?php echo CHtml::encode(date("Y-m-d H:i:s", $model->dateline)); ?></p>
<div class="row-fluid">
    <div class="row-fluid span7">
        <h3><?php echo CHtml::encode($model->title);?></h3>
        <div class="row-fluid">
            <div class="span4">
                <img class='img-polaroid' src="<?php echo CommonHelper::getImageByType($model->pic, 'chinchillaMarket', 'normal', 'url') ?>" onerror='javascript:this.src ="<?php echo Yii::app()->baseUrl."/images/static/common/default_320.png";?>"'/>
            </div>
            <div class="span5">
                <dl class="dl-horizontal">
                    <dt><span class="label label-success">毛色</span></dt>
                    <dd>
                        <span class="badge badge-info">
                        <?php echo CHtml::encode($model->getChinchillaColor($model->breed)); ?>
                        </span>
                    </dd>
                    <dt><span class="label label-success">性别</span></dt>
                    <dd><span class="badge badge-info"><?php echo CHtml::encode($model->gender ? 'DD' : 'MM'); ?></span></dd>
                    <dt><span class="label label-success">体重</span></dt>
                    <dd><span class="badge badge-info"><?php echo CHtml::encode($model->weight); ?>g</span></dd>
                    <dt><span class="label label-success">价格</span></dt>
                    <dd><span class="badge badge-info">￥<?php echo CHtml::encode($model->price); ?></span></dd>
                    <dt><span class="label label-success">出生日期</span></dt>
                    <dd><span class="badge badge-info"><?php echo CHtml::encode(date("Y-m-d", $model->birthday)); ?></span></dd>
                    <dt><span class="label label-important">交易过期时间</span></dt>
                    <dd><span class="badge <?php echo $model->displayorder >=0 ? 'badge-info' : 'badge-important';?>"><?php echo $model->displayorder >=0 ? CHtml::encode(date("Y-m-d", $model->expiredDate)) : '已结束';?></span></dd>
                    <?php if($model->displayorder>=0):?>
                    <dt><span class="label label-success">联系方式</span></dt>
                    <dd>
                        <span class="badge badge-info">
                        <?php 
                            if ($model->contact) {
                              $contacts = explode(',', $model->contact);
                              if (count($contacts)>1) {
                                  foreach ($contacts as $contact){
                                      echo CHtml::encode($contact)."<br />";
                                  }
                              }else{
                                  echo CHtml::encode($model->contact);
                              }
                            }else{
                                echo '无';
                            }
                            
                        ?>    
                        </span>
                    </dd>
                    <?php endif;?>
                </dl>
            </div>
            <div class="span2 pull-right">
                <img class='img-circle' src='<?php echo Yii::app()->request->getBaseUrl(true)."/images/static/totorocross/".$model->breed.".jpg"; ?>'>
            </div>
        </div>
        <div class='row-fluid'> &nbsp;</div>
        <div class="row-fluid ">
            <p class='label label-info'>相关图片</p>
            <ul class="thumbnails">
                <?php if (isset($tradeImages)): ?>
                    <?php foreach ($tradeImages as $key => $image): ?>
                        <li class="span3">
                            <div class="thumbnail">
                                <a class='lightbox' href="<?php echo CommonHelper::getImageByType($image->filepath, "chinchillaMarket", "big", 'url',1); ?>">
                                    <img src="<?php echo CommonHelper::getImageByType($image->filepath, "chinchillaMarket", "normal", 'url'); ?>" onerror='javascript:this.src ="<?php echo Yii::app()->baseUrl."/images/static/common/default_320.png";?>"'/>
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div class="row-fluid well">
            <blockquote class="text-info">
                <?php echo TimePicCode::TpCode($model->description); ?>
            </blockquote>
        </div>
        <div class="row-fluid well show_nave">
            <script type="text/javascript">
                (function(){
                    var url = "http://widget.weibo.com/distribution/comments.php?width=0&url=auto&color=cccccc,ffffff,4c4c4c,5093d5,cccccc,f0f0f0&colordiy=1&ralateuid=<?php echo $model->author->openIDType == 1 ? $model->author->openID : "2734978073"?>&appkey=3706708774&dpc=1";
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
    </div>
    <div class="row-fluid span4 pull-right well">
        <div class='alert alert-block'>
            <h4>提示：</h4>
            直接评论并勾选同步到微博，将在weibo@发布者。他会收到通知并回复您。<br/><br/>
            点击右上角<strong class="text-success">微博登陆</strong>即可发布龙猫信息。
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
	$('a.lightbox').lightBox();
});
</script>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.lightbox.js");?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/lightbox.css");?>
<?php
Yii::app()->clientScript->registerScript('admin_lightbox',"$('a.lightbox').lightBox();", CClientScript::POS_READY);
?>
