<?php
if (Yii::app()->request->isAjaxRequest) {
    Yii::app()->clientScript->scriptMap['jquery.js'] = false;
    Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
}
$this->breadcrumbs=array(
	'Ieltseye Speaking Topic Samples'=>array('index'),
	'Create',
);

$this->menu = array(
    array('label' => 'List', 'url' => array('index')),
    array('label' => 'Manage', 'url' => array('admin')),
);
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'ieltseye-speaking-topic-sample-form',
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

<div class="row-fluid">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Create Sample</h3>
  </div>
  <div id ="adminModalBody" class="modal-body">
    <div class="row-fluid">
        <div class="topicCard">
            <div class="part"><?php echo "Part ".$card->type;?></div>
            <legend><?php echo CHtml::encode($card->question);?></legend>
            <?php if ($card->type == 2): ?>
                <p>You should say:</p>
                <div class="description">
                    <?php echo TimePicCode::TpCode(CHtml::encode($card->description)); ?>
                </div>
            <?php endif; ?>
        </div>
        <p class="help-block">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textAreaRow($model,'content',array('rows'=>20, 'cols'=>50, 'class'=>'span8')); ?>

        <?php echo $form->textFieldRow($model,'author',array('class'=>'span5','maxlength'=>30)); ?>

        <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>30)); ?>

        <?php echo $form->textAreaRow($model,'source',array('rows'=>2, 'cols'=>50, 'class'=>'span8')); ?>

        <?php echo $form->textFieldRow($model,'displayorder',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'cardid',array('class'=>'span5')); ?>

    </div>
  </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" id="closeSampleFormModal">Close</button>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ));
        ?>
    </div>
    
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
function postSample(form,data,hasError){
    $.ajax({
       type: 'POST',
        url: '<?php echo $this->createUrl('/admin/ieltseyeSpeakingTopicSample/create/id/'.$model->cardid, array('window'=>'true'));?>',
       data:form.serialize(),
       dataType:'html',
       success:function(data){
                    if (data == 'ok') {
                          $("#adminModalBody").html("创建成功！");
                          setTimeout("$('#closeSampleFormModal').click()",1000);
                    }
                  },
       error: function(data) { // if error occured
             alert("Error occured.please try again");
             $('#closeSampleFormModal').click();
        }
      });
}
        
</script>