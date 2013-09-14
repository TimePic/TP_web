<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('龙猫市场'),
)); 
$this->pageTitle .= "-首页";
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
    <div class="row-fluid">
        <ul class="inline">
            <?php $colorParams = $_GET; ?>
            <li><span class="label label-inverse">颜色:</span></li>
            <li><a <?php echo $_GET['color']=='-' || $_GET['color']==''    ? 'class="label label-info"': ''; ?> href="<?php $colorParams['color']='-';  echo $this->createUrl('index',$colorParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['color']=='gray'  ? 'class="label label-info"': ''; ?> href="<?php $colorParams['color']='gray';  echo $this->createUrl('index',$colorParams); ?>">标灰</a></li>
            <li><a <?php echo $_GET['color']=='white' ? 'class="label label-info"': ''; ?> href="<?php $colorParams['color']='white'; echo $this->createUrl('index',$colorParams); ?>">白色</a></li>
            <li><a <?php echo $_GET['color']=='black' ? 'class="label label-info"': ''; ?> href="<?php $colorParams['color']='black'; echo $this->createUrl('index',$colorParams); ?>">黑色</a></li>
            <li><a <?php echo $_GET['color']=='beige' ? 'class="label label-info"': ''; ?> href="<?php $colorParams['color']='beige'; echo $this->createUrl('index',$colorParams); ?>">米色</a></li>
            <?php unset($colorParams); ?>
        </ul>
    </div>
    <div class="row-fluid">
        <ul class="inline">
            <?php $velvetParams = $_GET; ?>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <li><a <?php echo $_GET['velvet']=='-' || $_GET['velvet']=='' ? 'class="label label-info"': ''; ?> href="<?php $velvetParams['velvet']='-';  echo $this->createUrl('index',$velvetParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['velvet']=='0' ? 'class="label label-info"': ''; ?> href="<?php $velvetParams['velvet']='0';  echo $this->createUrl('index',$velvetParams); ?>">无丝绒</a></li>
            <li><a <?php echo $_GET['velvet']=='1' ? 'class="label label-info"': ''; ?> href="<?php $velvetParams['velvet']='1';  echo $this->createUrl('index',$velvetParams); ?>">丝绒</a></li>
            <?php unset($velvetParams); ?>
        </ul>
    </div>
    <div class="row-fluid">
        <ul class="inline">
            <?php $geneParams = $_GET; ?>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <li><a <?php echo $_GET['gene']=='-' || $_GET['gene']=='' ? 'class="label label-info"': ''; ?> href="<?php $geneParams['gene']='-';  echo $this->createUrl('index',$geneParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['gene']=='0' ? 'class="label label-info"': ''; ?> href="<?php $geneParams['gene']='0';  echo $this->createUrl('index',$geneParams); ?>">无隐性颜色</a></li>
            <li><a <?php echo $_GET['gene']=='violet' ? 'class="label label-info"': ''; ?> href="<?php $geneParams['gene']='violet';  echo $this->createUrl('index',$geneParams); ?>">紫灰</a></li>
            <li><a <?php echo $_GET['gene']=='sapphire' ? 'class="label label-info"': ''; ?> href="<?php $geneParams['gene']='sapphire';  echo $this->createUrl('index',$geneParams); ?>">蓝灰</a></li>
            <?php unset($geneParams); ?>
        </ul>
    </div>
    <div class="row-fluid">
        <ul class="inline">
            <?php $genderParams = $_GET; ?>
            <li><a href="#" class="label label-inverse">性别:</a></li>
            <li><a <?php echo $_GET['gender']=='-' || $_GET['gender']=='' ? 'class="label label-info"': ''; ?> href="<?php $genderParams['gender']='-';  echo $this->createUrl('index',$genderParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['gender']=='0' ? 'class="label label-info"': ''; ?> href="<?php $genderParams['gender']='0';  echo $this->createUrl('index',$genderParams); ?>">DD</a></li>
            <li><a <?php echo $_GET['gender']=='1' ? 'class="label label-info"': ''; ?> href="<?php $genderParams['gender']='1';  echo $this->createUrl('index',$genderParams); ?>">MM</a></li>
            <?php unset($genderParams); ?>
        </ul>
    </div>
    <div class="row-fluid">
        <ul class="inline">
            <?php $weightParams = $_GET; ?>
            <li><a href="#" class="label label-inverse">体重:</a></li>
            <li><a <?php echo $_GET['weight']=='-' || $_GET['weight']==''? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='-';  echo $this->createUrl('index',$weightParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['weight']=='1' ? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='1';  echo $this->createUrl('index',$weightParams); ?>">1-100g</a></li>
            <li><a <?php echo $_GET['weight']=='2' ? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='2';  echo $this->createUrl('index',$weightParams); ?>">100-300g</a></li>
            <li><a <?php echo $_GET['weight']=='3' ? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='3';  echo $this->createUrl('index',$weightParams); ?>">300-500g</a></li>
            <li><a <?php echo $_GET['weight']=='4' ? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='4';  echo $this->createUrl('index',$weightParams); ?>">500-600g</a></li>
            <li><a <?php echo $_GET['weight']=='5' ? 'class="label label-info"': ''; ?> href="<?php $weightParams['weight']='5';  echo $this->createUrl('index',$weightParams); ?>">600g以上</a></li>
            <?php unset($weightParams); ?>
        </ul>
    </div>
    <div class="row-fluid">
        <ul class="inline">
            <?php $priceParams = $_GET; ?>
            <li><a href="#" class="label label-inverse">价格:</a></li>
            <li><a <?php echo $_GET['price']=='-' || $_GET['price']=='' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='-';  echo $this->createUrl('index',$priceParams); ?>">不限</a></li>
            <li><a <?php echo $_GET['price']=='1' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='1';  echo $this->createUrl('index',$priceParams); ?>">1-400</a></li>
            <li><a <?php echo $_GET['price']=='2' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='2';  echo $this->createUrl('index',$priceParams); ?>">400-1000</a></li>
            <li><a <?php echo $_GET['price']=='3' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='3';  echo $this->createUrl('index',$priceParams); ?>">1000-2000</a></li>
            <li><a <?php echo $_GET['price']=='4' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='4';  echo $this->createUrl('index',$priceParams); ?>">2000-3000</a></li>
            <li><a <?php echo $_GET['price']=='5' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='5';  echo $this->createUrl('index',$priceParams); ?>">3000-4000</a></li>
            <li><a <?php echo $_GET['price']=='6' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='6';  echo $this->createUrl('index',$priceParams); ?>">4000-5000</a></li>
            <li><a <?php echo $_GET['price']=='7' ? 'class="label label-info"': ''; ?> href="<?php $priceParams['price']='7';  echo $this->createUrl('index',$priceParams); ?>">5000以上</a></li>
            <?php unset($priceParams); ?>
        </ul>
    </div>
</div>
<div class="row-fluid">
    <div class="row-fluid">
        <?php if(isset($data)): ?>
          <?php  foreach ($data as $item):?>
            <div class="row-fluid well well-large trade">
                <div class="span2">
                    <a href="<?php echo $this->createUrl('view', array('id'=>$item['tradeId']))?>" target="_blank">
                        <img class="tradeImage" src="<?php echo CommonHelper::getImageByType($item['pic'], 'chinchillaMarket', 'thumb', 'url');?>" onerror='javascript:this.src ="<?php echo Yii::app()->baseUrl."/images/static/common/default_100.png";?>"'>
                    </a>
                </div>
                <div class="offset2 row-fluid detail">
                    <p class=""><a href="<?php echo $this->createUrl('view', array('id'=>$item['tradeId']))?>" target="_blank"><strong>[<?php echo $item['gender'] ? 'MM' :'DD';?>] <?php echo CHtml::encode($item['title']);?></strong></a></p>
                    <p class="label label-info price">￥<?php echo CHtml::encode($item['price']);?></p>
                    <p class="muted"><?php echo CHtml::encode($item['memberInfo']['username']); ?> - <?php echo CHtml::encode(date("Y-m-d H:i:s", $item['dateline'])); ?> - <?php echo CHtml::encode(intval($item['views']));?>人浏览</p>
                </div>
            </div>
          <?php endforeach;?>
        <?php else: ?>
            <div class="row-fluid well well-large">
                <div class="alert alert-error">
                  哦呦,貌似还木有这样的龙猫出现...
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="pagination">
          <?php $this->widget('bootstrap.widgets.TbPager', 
              array('pages'=>$pages,
                  
                )
        );?>
</div>