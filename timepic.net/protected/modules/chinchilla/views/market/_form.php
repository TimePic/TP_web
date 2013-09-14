<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/SWFUpload/swfupload.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/SWFUpload/application_handlers.js"); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/SWFUpload.css"); ?>
<script type="text/javascript">
var TPSWFUPLOADIMAGEPATH = '<?php echo Yii::app()->request->getBaseUrl(true).'/images/static/common/SWFUpload/'?>';
var TPTHUMBNAILURL = '<?php echo Yii::app()->request->getBaseUrl(true).$this->createUrl('showTmpThumbnail')?>';
var TPPHPSESSID = '<?php echo Yii::app()->session->sessionID; ?>';
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "<?php echo $this->createUrl('uploadTradePic')?>",
                post_params: {"PHPSESSID": "<?php echo Yii::app()->session->sessionID; ?>", 'tradeId':'<?php echo isset($model->tradeId) ? $model->tradeId: 0;?>'},

				// File Upload Settings
				file_size_limit : "2 MB",	// 2MB
				file_types : "*.jpg",
				file_types_description : "JPG Images",
				file_upload_limit : "4",

				// Event Handler Settings - these functions as defined in Handlers.js
				//  The handlers are not part of SWFUpload but are part of my website and control how
				//  my website reacts to the SWFUpload events.
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : "",
				button_placeholder_id : "SWFUploadButtonPlaceholder",
				button_width: 180,
				button_height: 20,
				button_text : '<span class="button">选择图片 (2 MB)</span>',
				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 14px; color:#ffffff;}',
				button_text_top_padding: 3,
				button_text_left_padding: 12,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				// Flash Settings
				flash_url : "<?php echo Yii::app()->request->getBaseUrl(true);?>/js/SWFUpload/swfupload.swf",

				custom_settings : {
					upload_target : "SWFUploadFileProgressContainer"
				},
				
				// Debug Settings
				debug: false
			});
		};
	</script>
<?php $form=$this->beginWidget('CActiveForm',array(
	'id'=>'chinchilla-market-trade-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'breed'),
	'htmlOptions'=>array('class'=>'form-horizontal'),
	'clientOptions'=>array('validateOnSubmit'=>true,
							'afterValidate' => 'js:checkChinchillaForm',
		)

)); ?>
	<div class="alert alert-info" id="chinchillaNotice">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>提示</h4>
	  如果颜色选项中没有您要描述的龙猫颜色，请点击高级模式进行选择。
	</div>

	<div class="control-group" >
		<div class="span4" id="classicColorChoosing" >
			<div class="control-group">
				<?php echo CHtml::link('高级模式', '#', array('class'=>'btn btn-primary offset1 span1', 'onclick'=>"ChangeMenu('advanced');")) ?>
			</div>
			<div class="control-group">
				<?php echo CHtml::label('颜色<span class="required">*</span>', 'ChinchillaMarketTrade_Gene_classic',array('class'=>'control-label')) ?>
				<div class="controls">
                    <?php 
                          //classic mode default value check
                          $classicModeDefaultValue = '600000';
                          if(isset($model->tradeId)){
                              if (!$model->mode) {
                                 $classicModeDefaultValue = $model->breed; 
                              }
                          }
                    ?>
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[classic]', $classicModeDefaultValue, array(
                                                                             600000=>'标灰',
																			 600100=>'纯白或银白',
                                                                             600110=>'粉白红眼',
																			 640000=>'纯黑',
                                                                             600010=>'米色',
                                                                             300000=>'紫灰',
                                                                             100000=>'蓝灰',
																			),
																		array('class'=>'input-small','onchange'=>"UpdateChinchillaImage('Chinchilla');")
																			); ?>
				</div>
			</div>			
		</div>
		<div class="span4" id="advancedColorChoosing" style="display:none;">
			<div class="control-group">
				<?php echo CHtml::link('经典模式', '#', array('class'=>'btn btn-primary offset1 span1', 'onclick'=>"ChangeMenu('classic');")) ?>
			</div>
            <?php
            //advanced mode default value check
              $Gene_id1_checked = $Gene_id2_checked = $Gene_id3_checked = $Gene_id4_checked = 0;
            $Gene_id5_checked = 6;
            if (isset($model->tradeId)) {
                if ($model->mode) {
                    $Gene_id1_checked = $model->beige;
                    $Gene_id2_checked = $model->white;
                    $Gene_id3_checked = $model->velvet;
                    $Gene_id4_checked = $model->black;
                    if ($model->violet) {
                        $Gene_id5_checked = $model->black;
                    } elseif ($model->sapphire) {
                        $Gene_id5_checked = $model->sapphire;
                    } else {
                        $Gene_id5_checked = 6;
                    }
                }
            }
            ?>
			<div class="control-group">
				<?php echo CHtml::label(Yii::t('Base','Beige'), 'ChinchillaMarketTrade_Gene_id1',array('class'=>'control-label')) ?>
				<div class="controls">
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[Gene_id1]', $Gene_id1_checked, array(0=>Yii::t('Base', 'No Beige'),
																			 1=>Yii::t('Base', 'Hetero-Beige'),
																			 2=>Yii::t('Base', 'Homo-Beige')
																			),
																		array('class'=>'input-small','onchange'=>"UpdateParentImage('Chinchilla');")
																			); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo CHtml::label(Yii::t('Base','White'), 'ChinchillaMarketTrade_Gene_id2',array('class'=>'control-label')) ?>
				<div class="controls">
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[Gene_id2]', $Gene_id2_checked, array(0=>Yii::t('Base', 'No White'),
																								 1=>Yii::t('Base', 'White')
																								),
																							array('class'=>'input-small','onchange'=>"UpdateParentImage('Chinchilla');")
																							); ?>
				</div>
			</div>
			<div class="control-group">

				<?php echo CHtml::label(Yii::t('Base','Velvet'), 'ChinchillaMarketTrade_Gene_id3',array('class'=>'control-label')) ?>
				<div class="controls">
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[Gene_id3]', $Gene_id3_checked, array(0=>Yii::t('Base', 'No Velvet or TOV'),
																								 1=>Yii::t('Base', 'Velvet or TOV')
																								),
																							array('class'=>'input-small','onchange'=>"UpdateParentImage('Chinchilla');")
																							); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo CHtml::label(Yii::t('Base','Ebony'), 'ChinchillaMarketTrade_Gene_id4',array('class'=>'control-label')) ?>
				<div class="controls">
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[Gene_id4]', $Gene_id4_checked, array(0=>Yii::t('Base', 'No Ebony'),
																								 1=>Yii::t('Base', 'Light Ebony (or Carrier)'),
																								 2=>Yii::t('Base', 'Medium Ebony'),
																								 3=>Yii::t('Base', 'Dark Ebony'), 
																								 4=>Yii::t('Base', 'Extra Dark Ebony (Homo)')
																								),
																							array('class'=>'input-small','onchange'=>"UpdateParentImage('Chinchilla');")
																							); ?>
				</div>
			</div>
			<div class="control-group">
				<?php echo CHtml::label(Yii::t('Base','Vio/Sap'), 'ChinchillaMarketTrade_Gene_id5',array('class'=>'control-label')) ?>
				<div class="controls">
					<?php echo CHtml::dropDownList('ChinchillaMarketTrade[Gene_id5]', $Gene_id5_checked, array(6=>Yii::t('Base', 'No Recessive'),
																								 3=>Yii::t('Base', 'Violet'),
																								 1=>Yii::t('Base', 'Sapphire'),
																								 5=>Yii::t('Base', 'Violet-Carrier'),
																								 4=>Yii::t('Base', 'Sapphire-Carrier'),
																								),
																							array('class'=>'input-small','onchange'=>"UpdateParentImage('Chinchilla');")
																							); ?>

					<?php echo $form->error($model,'breed', array('class'=>'help-inline error')); ?>
				</div>
			</div>


		</div>
		<div class="span2">
			<Legend>
				
				<div class="row-fluid">
					<div class="icon-home"> </div>
					<img id="ChinchillaImage" class="img-circle"  src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/600000.jpg" alt="Chinchilla Sire Phenotype" />
				</div>
				<?php echo CHtml::label(' ', 'ChinchillaImage',array('id'=>'chinchillaColor','class'=>'label-info label block')) ;?>
			</Legend>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'gender', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->radioButtonList($model,'gender',array('0'=>'DD', '1'=>'MM'), array('labelOptions'=>array('separator'=>' ','class'=>'radio inline'))); ?>
			<?php echo $form->error($model,'gender', array('class'=>'help-inline error')); ?>
		</div>

	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'birthday', array('class'=>'control-label')); ?>
		<div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'attribute' => 'birthday',
                'model' => $model,
                'options' => array(
                    'mode' => 'focus',
                    'dateFormat' => 'yy/mm/dd',
                    'showAnim' => 'slideDown',
                ),
                'htmlOptions' => array('class' => 'input-medium', 'value' => isset($model->tradeId) ? $model->birthday : date('Y/m/d',time())),
                    )
            );
            ?>
			<?php echo $form->error($model,'birthday', array('class'=>'help-inline error')); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'expiredDate', array('class'=>'control-label')); ?>
		<div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'attribute' => 'expiredDate',
                'model' => $model,
                'options' => array(
                    'dateonly'=>true,
                    'mode' => 'focus',
                    'dateFormat' => 'yy/mm/dd',
                    'showAnim' => 'slideDown',
                ),
                'htmlOptions' => array('class' => 'input-medium', 'value' => isset($model->tradeId) ? $model->expiredDate : date('Y/m/d',time()+2592000)),
                    )
            );
            ?>
			<?php echo $form->error($model,'expiredDate', array('class'=>'help-inline error')); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'weight', array('class'=>'control-label')); ?>
		<div class="controls ">
			<div class="input-append">
				<?php echo $form->numberField($model,'weight',array('class'=>'input-small')); ?>
				<span class="add-on">g</span>
			</div>	
			<?php echo $form->error($model,'weight', array('class'=>'help-inline error')); ?>
		</div>
	</div>


	<div class="control-group">
		<?php echo $form->labelEx($model,'price', array('class'=>'control-label')); ?>
		<div class="controls">
			<div class="input-prepend input-append">
				<span class="add-on">￥</span>
					<?php echo $form->numberField($model,'price',array('class'=>'input-small')); ?>
				<span class="add-on">RMB</span>
			</div>
				<?php echo $form->error($model,'price', array('class'=>'help-inline error')); ?>
		</div>
	</div>

    <!--SFWupload-->
    <?php if($model->tradeId):?>
 
        <div class="control-group">
            <?php echo CHtml::label('相关图片', '', array('class'=>'control-label'));?>
            <div class="controls">
                <ul class="thumbnails">
                    <?php if(isset($tradeImages)):?>
                    <?php foreach($tradeImages as $key => $image):?>
                        <li class="span2">
                            <div class="thumbnail text-center">
                                <img src="<?php echo CommonHelper::getImageByType($image->filepath, "chinchillaMarket", "thumb", 'url');?>" />
                            </div>
                            <div class="text-center">
                                
                                <?php
                                     $isChecked = false;
                                     if ($model->pic == $image->filepath) {
                                         $isChecked = true;
                                     }elseif($key === 0){
                                         $isChecked = true;
                                     }
                                    echo CHtml::radioButton('ChinchillaMarketTrade[cover]', $isChecked, array('onclick'=>'$("#coverPic").val("'.$image->filepath.'");'));
                                ?>封面
                                <a href="<?php echo $this->createUrl('deleteTradePic',array('id'=>$image->picid,'tradeId'=>$model->tradeId))?>"><i class="icon-trash"></i></a>
                            </div>
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
            <?php echo $form->HiddenField($model,'pic', array('id'=>'coverPic')); ?>
            <?php echo $form->error($model,'pic', array('class'=>'help-inline error')); ?>
        </div>
    
    <?php endif;?>
 
	<div class="control-group">
		<?php echo CHtml::label('上传图片(4张)', '', array('class'=>'control-label'));?>
        <span class="required">*</span>
		<div class="controls">
			<div class="btn btn-primary">
				<span id="SWFUploadButtonPlaceholder"></span>
			</div>
			<div id="SWFUploadFileProgressContainer" style="height: 75px;"></div>
			<div id="SWFUploadthumbnails"></div>
		</div>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'contact', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'contact',array('class'=>'span5','maxlength'=>60)); ?>
			<div class="row-fluid">
                <p class="text-warning">不同联系方式请以,分割。为了保护隐私，交易结束后，联系方式将会隐藏。</p>
				<?php echo $form->error($model,'contact', array('class'=>'help-inline error')); ?>
			</div>
		</div>
	</div>
    
	<div class="control-group">
		<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'title',array('class'=>'span5','maxlength'=>60)); ?>
			<div class="row-fluid">
				<?php echo $form->error($model,'title', array('class'=>'help-inline error')); ?>
			</div>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'description', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textArea($model,'description',array('rows'=>12, 'cols'=>50, 'class'=>'span5')); ?>
			<div class="row-fluid">
				<?php echo $form->error($model,'description', array('class'=>'help-inline error')); ?>
			</div>
            <div class="row-fluid">
                同步到微博<?php echo CHtml::checkBox('ChinchillaMarketTrade[syncWB]', true)?>
            </div>
		</div>
	</div>
    <?php echo $form->HiddenField($model,'mode', array('id'=>'picMode')); ?>
	<input type="hidden" value="0" id="ChinchillaGVC" name="ChinchillaGVC" />


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		 )); ?>
	</div>

<?php $this->endWidget(); ?>
<script language="javascript">
	function checkChinchillaForm(){
		if ($("#ChinchillaGVC").val() == 0) {
			alert('颜色选择异常，建议保存数据，重新刷新该页面！');
			return false;
		};
        <?php if(!isset($model->tradeId)):?>
            if ($("#SWFUploadthumbnails > img").length == 0) {
                alert('至少上传一张图片。');
                return false;
            };
        <?php endif;?>


		return true;
	}
    
	function ChangeMenu(menu){
        advancedMenu = $('#advancedColorChoosing');
		classicMenu = $('#classicColorChoosing');
		if (menu == 'classic') {
			advancedMenu.hide('normal');
			classicMenu.show('normal');
			UpdateChinchillaImage('Chinchilla');
            $('#picMode').val(0);
		}else{
			classicMenu.hide('normal');
			advancedMenu.show('normal');
			UpdateParentImage("Chinchilla");
            $('#picMode').val(1);
		};
		
	}
	
	function UpdateChinchillaImage(Parent) {
		var GenotypeValueCode;
		GenotypeValueCode = $('#ChinchillaMarketTrade_classic').val();
		var Imgid = "#"+Parent+"Image";
		var src = $(Imgid).src = "<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/" + GenotypeValueCode + ".jpg";
		$(Imgid).hide('fast',function(){$(Imgid).attr('src', src);});
		$(Imgid).show('fast');
		CalcGenotype(GenotypeValueCode);
	}

	function UpdateParentImage(Parent) {
		var GenotypeValueCode;
		GenotypeValueCode = CompileGenotypeValueCode('ChinchillaMarketTrade_');
		var Imgid = "#"+Parent+"Image";
		var src = $(Imgid).src = "<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/" + GenotypeValueCode + ".jpg";
		$(Imgid).hide('fast',function(){$(Imgid).attr('src', src);});
		$(Imgid).show('fast');
		// $(Imgid).attr('src', src);
	}

	function CompileGenotypeValueCode(Parent) {
		var x,el,Gene_id;
		var GenotypeValueCode=0;
		for (x=0;x<$("select").length;x++) {
			el=$("select")[x];
			// ChinchillaMarketTrade[Gene_id3]
			if (el.id.substr(0,Parent.length + 7)==(Parent+ "Gene_id")) {
				Gene_id=el.name.substr(Parent.length + 7);
				GenotypeValueCode += Math.pow(10,parseInt(Gene_id)) * el.value;
			}
		}
		CalcGenotype(GenotypeValueCode);
		return(GenotypeValueCode);
	}

	function CalcGenotype(GenotypeValueCode) {
		$("#ChinchillaGVC").val(GenotypeValueCode);
		colorObject=$.ajax({url:"<?php echo Yii::app()->request->getBaseUrl(true);?>/chinchilla/market/getChinchillaColor/imageid/"+GenotypeValueCode,async:false});
  			$("#chinchillaColor").html(colorObject.responseText);
	}
	//Update the images using a script, so that browsers which don't support script, show the unknown image. UpdateParentImage("Sire");
	UpdateChinchillaImage('Chinchilla');
    <?php if(isset($model->mode)):?>
        <?php if($model->mode):?>
            ChangeMenu('advanced');
        <?php endif;?>
    <?php endif;?>
	</script>
