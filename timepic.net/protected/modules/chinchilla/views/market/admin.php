<?php
$this->pageTitle .= "-我的龙猫市场";
?>

<div class="row-fluid">
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links'=>array('龙猫市场'=>array('index'), '我的龙猫市场'),
)); ?>
</div>
<div class="row-fluid">
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'龙猫市场', 'url'=>array('index')),
        array('label'=>'创建龙猫交易', 'url'=>array('create')),
        array('label'=>'我的龙猫市场', 'url'=>array('admin'), 'active'=>true),
    ),
    'htmlOptions'=>array('class'=> 'pull-right'),
)); ?>
</div>
<div class='row-fluid'>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'chinchilla-market-trade-grid',
	'dataProvider'=>$dataprovider,
	'columns'=>array(
		'tradeId',
		array('name'=>'pic', 'type'=>'image', 'value'=>'CommonHelper::getImageByType($data->pic, "chinchillaMarket", "thumb", "url")'),
		array('name'=>'title', 'value'=>'CommonHelper::cutstr($data->title, 20)'),
        array('name'=>'breed', 'value'=>'ChinchillaMarketTrade::getChinchillaColor($data->breed)'),
		array('name'=>'gender', 'value'=>'$data->gender? MM : DD'),
		array('name'=>'weight', 'value'=>'$data->weight'),
		'price',
        array('name'=>'displayorder', 'value'=>'$data->weight >= 0 ?开启:关闭'),
		array('name' => 'dateline', 'value' => 'date("Y-m-d H:i:s", $data->dateline)'),
		array(
            'header'=>'操作',
            'headerHtmlOptions'=>array('width'=>'10%'),
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}{update}{tradeOff}{tradeOn}',
            'buttons'=>array(
                'tradeOff' => array(
                    'label'=>'<i class="icon-arrow-down"></i>',
                    'options'=>array('title'=>'关闭交易'),
                    'url' => 'Yii::app()->createUrl("chinchilla/market/tradeSwitch",array("id"=>$data->tradeId, "status"=>"off"))',
                    'visble'=>'intval($data->displayorder) >= 0',
                    'click' => 'function(){return confirm("将关闭此交易，您的交易中的联系方式将被隐藏，确认关闭？");}',
                ),
                'tradeOn' => array(
                    'label'=>'<i class="icon-arrow-up"></i>',
                    'options'=>array('title'=>'开启交易'),
                    'url' => 'Yii::app()->createUrl("chinchilla/market/tradeSwitch",array("id"=>$data->tradeId, "status"=>"on"))',
                    'visble'=>'0',
                    'click' => 'function(){return confirm("开启交易，过期时间将自动延期7天，也可以通过修改该交易过期时间延期。确认开启？");}',
                ),
            ),
		),
	),
)); ?>
</div>
