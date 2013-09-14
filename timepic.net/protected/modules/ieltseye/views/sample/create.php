<?php
if (Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
}
?>
<div class="row-fluid">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Sample</h3>
    </div>

    <div class="modal-body" id="topicCardBody">
      <div class="topicCard">
            <div class="part"><?php echo "Part ".$topicCard->type;?></div>
            <legend><?php echo CHtml::encode($topicCard->question);?></legend>
            <?php if ($topicCard->type == 2): ?>
                <p>You should say:</p>
                <div class="description">
                    <?php echo TimePicCode::TpCode(CHtml::encode($topicCard->description)); ?>
                </div>
            <?php endif; ?>
        </div>
        <div>
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'IELTSeyeSpeakingSampleForm',
                'action'=>$this->createUrl('/sample/create'),
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'afterValidate' => 'js:function(form,data,hasError){  
                                            if(!hasError){
                                                postSample(form,data,hasError);
                                            }
                                        }'
                ),
                'focus' => array($model, 'content'),
                'htmlOptions' => array('onsubmit' => 'return false;',
                    ),
            ));
        ?>
            
            <p class="help-block">Fields with <span class="required">*</span> are required.</p>
            <div class="control-group">
                <?php echo $form->labelEx($model,'content', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model,'content',array('rows'=>15, 'cols'=>40, 'class'=>'span8')); ?> 
                    <?php echo $form->error($model,'content', array('class'=>'help-inline error')); ?>
                </div>

            </div>

            <div class="control-group">
                <?php echo $form->labelEx($model,'author', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model,'author',array('class'=>'span3','maxlength'=>30)); ?>
                    <?php echo $form->error($model,'author', array('class'=>'help-inline error')); ?>
                </div>   
            </div>
            <div class="control-group">
                <?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model,'email',array('class'=>'span3','maxlength'=>30)); ?>
                    <?php echo $form->error($model,'email', array('class'=>'help-inline error')); ?>
                </div>   
            </div>
            
             <?php if(CCaptcha::checkRequirements()): ?>
            <div class="control-group">
                <?php echo $form->labelEx($model,'verifyCode', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>Yii::t('Base','Click'),'title'=>Yii::t('Base','Click'),'style'=>'cursor:pointer'))); ?>
                    <?php echo $form->textField($model,'verifyCode',array('class'=>'input-small','maxlength'=>10)); ?>
                    <?php echo $form->error($model,'verifyCode', array('class'=>'help-inline error')); ?>
                </div>   
            </div>
            <?php endif; ?>
            <input type="hidden" value="<?php echo $topicCard->cardid?>"  name="IeltseyeSpeakingTopicSample[cardid]" />
        </div>    
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true" id="closeSampleFormModal">Close</button>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Create',
		 )); ?>
    </div>
<?php $this->endWidget(); ?>
</div>

<script type="text/javascript">
function postSample(form,data,hasError){
    $.ajax({
       type: 'POST',
        url: '<?php echo $this->createUrl('/sample/create/'.$topicCard->cardid);?>',
       data:form.serialize(),
       dataType:'html',
       success:function(data){
                    if (data == 'ok') {
                          $("#topicCardBody").html("Good job! Thumb up for you!");
                          setTimeout("$('#closeSampleFormModal').click()",3000);
                    }
                  },
       error: function(data) { // if error occured
             alert("Error occured.please try again");
             $('#closeSampleFormModal').click();
        }
      });
}
        
</script>