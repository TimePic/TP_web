<li class="span2" style="margin-left: 5px;">
        <a href="<?php echo Yii::app()->createUrl('totoroPic/view/'.$data['pid'])?>" class="thumbnail lightbox">
            <img class="img-rounded" src="<?php echo CommonHelper::getImageByType($data['filepath'], "totorotalk", "thumb", 'url', 1);?>" alt="totoropic">
        </a>
        <p>            
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>Yii::t('Base','share'),
                'type'=>'link',
                'size'=>'large',
                'block'=>true,
                'icon'=>'icon-share icon-gray',
                'htmlOptions'=>array(
                    'data-toggle'=>'modal',
                    'data-target'=>'#Modal_'.$data['pid'],
                ),
            )); ?>
        </p>
        
        <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'Modal_'.$data['pid'])); ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h4><?php echo Yii::t('Base','shareTitle');?></h4>
            </div>

            <div class="modal-body">
                <p>
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style">
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
                    <script type="text/javascript">
                    $('#<?php echo 'Modal_'.$data['pid'];?>').on('show', function (e) {
                        jiathis_config.url = "<?php echo Yii::app()->createAbsoluteUrl('/totoroPic/view/'.$data['pid'])?>";
                        jiathis_config.title = "#<?php echo Yii::t('Base','ShareTotorotalk');?>#";
                        jiathis_config.summary = "<?php echo Yii::t('Base','TotoroTalk_App_caption');?>";
                        jiathis_config.pic = "<?php echo CommonHelper::getImageByType($data['filepath'], "totorotalk", "normal", 'url', 1);?>";
                    });
                    </script>
                </p>
            </div>

            <div class="modal-footer">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>Yii::t('Base','Close'),
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>
            </div>

        <?php $this->endWidget(); ?>
</li>