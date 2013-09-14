<?php
$this->breadcrumbs=array(
	'Totoro Cross Calculator',
);?>

<?php if ($_POST):?>
<div class="row-fluid">
	<div class="well well-small">
            <?php if($kits):?>
                <div class="alert alert-success">
                    查询结果（<?php echo count($kits);?>）：查看详细信息，请鼠标移动到相应的图片之上。   
                </div>
            <?php endif?>
            <div>
                <ul class="thumbnails">
                    <?php foreach($kits as $kide):?>
                        <li style="height:194px;width:194px;" class="text-center">
                            <a style="height:100%;width:100%;" class="thumbnail" href="#" rel="tooltip" data-title="<?php echo $kide['probalility']; ?>" data-trigger="hover" >
                                <img style="height:81px;" class="img-circle" src="<?php echo Yii::app()->request->getBaseUrl(true) . "/images/static/totorocross/" . $kide['imageid'] . ".jpg"; ?>" />
                                <div><?php echo $kide['color'];?> </div>
                                <div><?php echo $kide['probalility']; ?></div>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
	</div>
</div>
<?php endif;?>

    
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'ChinCalc',
'enableAjaxValidation'=>false,
'htmlOptions'=>array('name'=>'ChinCalc'),
)); ?>
<div class="row-fluid">
	<div class="span6 well pull-left">		
		<fieldset>
			<Legend><?php echo Yii::t('Base','Dam');?><br />
				<img id="DamImage" class="img-circle" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/600000.jpg" alt="Chinchilla Dam Phenotype" />
			</Legend>
			<div class="control-group ">
				<label class="totorolabel span2" for="DamGene_id1"><?php echo Yii::t('Base','Beige');?> : </label>
				<div class="controls">
					<select name="DamGene_id1" id="DamGene_id1" onchange="UpdateParentImage('Dam');">
						<option <?php echo $formselect['DamGene_id1']['0'];?> value="0"><?php echo Yii::t('Base', 'No Beige'); ?></option>
						<option <?php echo $formselect['DamGene_id1']['1'];?>value="1"><?php echo Yii::t('Base', 'Hetero-Beige'); ?></option>
						<option <?php echo $formselect['DamGene_id1']['2'];?>value="2"><?php echo Yii::t('Base', 'Homo-Beige'); ?></option>
					</select>					
				</div>
			</div>
			<div class="control-group ">
				<label class="totorolabel span2" for="DamGene_id2"><?php echo Yii::t('Base','White');?> : </label>
				<div class="controls">
					<select name="DamGene_id2" id="DamGene_id2" onchange="UpdateParentImage('Dam');">
						<option <?php echo $formselect['DamGene_id2']['0'];?> value="0"><?php echo Yii::t('Base', 'No White'); ?></option>
						<option <?php echo $formselect['DamGene_id2']['1'];?>value="1"><?php echo Yii::t('Base', 'White'); ?></option>
					</select>					
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="DamGene_id3"><?php echo Yii::t('Base','Velvet');?> : </label>
				<div class="controls">
					<select name="DamGene_id3" id="SireGene_id3" onchange="UpdateParentImage('Dam');">
						<option <?php echo $formselect['DamGene_id3']['0'];?> value="0"><?php echo Yii::t('Base', 'No Velvet or TOV'); ?></option>
						<option <?php echo $formselect['DamGene_id3']['1'];?>value="1"><?php echo Yii::t('Base', 'Velvet or TOV'); ?></option>
					</select>				
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="DamGene_id4"><?php echo Yii::t('Base','Ebony');?> : </label>
				<div class="controls">
					<select name="DamGene_id4" id="DamGene_id4" onchange="UpdateParentImage('Dam');">
						<option <?php echo $formselect['DamGene_id4']['0'];?> value="0"><?php echo Yii::t('Base', 'No Ebony'); ?></option>
						<option <?php echo $formselect['DamGene_id4']['1'];?> value="1"><?php echo Yii::t('Base', 'Light Ebony (or Carrier)'); ?></option>
						<option <?php echo $formselect['DamGene_id4']['2'];?> value="2"><?php echo Yii::t('Base', 'Medium Ebony'); ?></option>
						<option <?php echo $formselect['DamGene_id4']['3'];?> value="3"><?php echo Yii::t('Base', 'Dark Ebony'); ?></option>
						<option <?php echo $formselect['DamGene_id4']['4'];?> value="4"><?php echo Yii::t('Base', 'Extra Dark Ebony (Homo)'); ?></option>
					</select>					
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="DamGene_id5"><?php echo Yii::t('Base','Vio/Sap');?> : </label>
				<div class="controls">
					<select name="DamGene_id5" id="DamGene_id5" onchange="UpdateParentImage('Dam');">
						<option <?php echo $formselect['DamGene_id5']['6'];?> value="6"><?php echo Yii::t('Base', 'No Recessive'); ?></option>
						<option <?php echo $formselect['DamGene_id5']['3'];?> value="3"><?php echo Yii::t('Base', 'Violet'); ?></option>
						<option <?php echo $formselect['DamGene_id5']['1'];?> value="1"><?php echo Yii::t('Base', 'Sapphire'); ?></option>
						<option <?php echo $formselect['DamGene_id5']['5'];?> value="5"><?php echo Yii::t('Base', 'Violet-Carrier'); ?></option>
						<option <?php echo $formselect['DamGene_id5']['4'];?> value="4"><?php echo Yii::t('Base', 'Sapphire-Carrier'); ?></option>
					</select>					
				</div>
			</div>
		</fieldset>
	</div>
	<div class="span6 pull-right well">
		<fieldset>
			<Legend><?php echo Yii::t('Base','Sire');?><br />
				<img id="SireImage" class="img-circle"  src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/600000.jpg" alt="Chinchilla Sire Phenotype" />
			</Legend>
			<div class="control-group ">
				<label class="totorolabel span2" for="SireGene_id1"><?php echo Yii::t('Base','Beige');?> : </label>
				<div class="controls">
					<select name="SireGene_id1" id="SireGene_id1" onchange="UpdateParentImage('Sire');">
						<option <?php echo $formselect['SireGene_id1']['0'];?>  value="0"><?php echo Yii::t('Base','No Beige');?></option>
						<option <?php echo $formselect['SireGene_id1']['1'];?> value="1"><?php echo Yii::t('Base','Hetero-Beige');?></option>
						<option <?php echo $formselect['SireGene_id1']['2'];?> value="2"><?php echo Yii::t('Base','Homo-Beige');?></option>
					</select>					
				</div>
			</div>
			<div class="control-group ">
				<label class="totorolabel span2" for="SireGene_id2"><?php echo Yii::t('Base','White');?> : </label>
				<div class="controls">
					<select name="SireGene_id2" id="SireGene_id2" onchange="UpdateParentImage('Sire');">
						<option <?php echo $formselect['SireGene_id2']['0'];?> value="0"><?php echo Yii::t('Base', 'No White'); ?></option>
						<option <?php echo $formselect['SireGene_id2']['1'];?> value="1"><?php echo Yii::t('Base', 'White'); ?></option>
					</select>					
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="SireGene_id3"><?php echo Yii::t('Base','Velvet');?> : </label>
				<div class="controls">
					<select name="SireGene_id3" id="SireGene_id3" onchange="UpdateParentImage('Sire');">
						<option <?php echo $formselect['SireGene_id3']['0'];?>  value="0"><?php echo Yii::t('Base', 'No Velvet or TOV'); ?></option>
						<option <?php echo $formselect['SireGene_id3']['1'];?> value="1"><?php echo Yii::t('Base', 'Velvet or TOV'); ?></option>
					</select>				
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="SireGene_id4"><?php echo Yii::t('Base','Ebony');?> : </label>
				<div class="controls">
					<select name="SireGene_id4" id="SireGene_id4" onchange="UpdateParentImage('Sire');">
						<option <?php echo $formselect['SireGene_id4']['0'];?>  value="0"><?php echo Yii::t('Base', 'No Ebony'); ?></option>
						<option <?php echo $formselect['SireGene_id4']['1'];?> value="1"><?php echo Yii::t('Base', 'Light Ebony (or Carrier)'); ?></option>
						<option <?php echo $formselect['SireGene_id4']['2'];?> value="2"><?php echo Yii::t('Base', 'Medium Ebony'); ?></option>
						<option <?php echo $formselect['SireGene_id4']['3'];?> value="3"><?php echo Yii::t('Base', 'Dark Ebony'); ?></option>
						<option <?php echo $formselect['SireGene_id4']['4'];?> value="4"><?php echo Yii::t('Base', 'Extra Dark Ebony (Homo)'); ?></option>
					</select>					
				</div>
			</div>
			
			<div class="control-group ">
				<label class="totorolabel span2" for="SireGene_id5"><?php echo Yii::t('Base','Vio/Sap');?> : </label>
				<div class="controls">
					<select name="SireGene_id5" id="SireGene_id5" onchange="UpdateParentImage('Sire');">
						<option <?php echo $formselect['SireGene_id5']['6'];?> value="6"><?php echo Yii::t('Base', 'No Recessive'); ?></option>
						<option <?php echo $formselect['SireGene_id5']['3'];?> value="3"><?php echo Yii::t('Base', 'Violet'); ?></option>
						<option <?php echo $formselect['SireGene_id5']['1'];?> value="1"><?php echo Yii::t('Base', 'Sapphire'); ?></option>
						<option <?php echo $formselect['SireGene_id5']['5'];?> value="5"><?php echo Yii::t('Base', 'Violet-Carrier'); ?></option>
						<option <?php echo $formselect['SireGene_id5']['4'];?> value="4"><?php echo Yii::t('Base', 'Sapphire-Carrier'); ?></option>
					</select>					
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row-fluid totorosubmit">
	<input type="hidden" value="GDVs" name="SubmissionMode" />

	<input type="hidden" value="600000" name="SireGVC" id="SireGVC"/>
	<input type="hidden" value="600000" name="DamGVC" id="DamGVC"/>
	<input onclick="CalcGenotype();" type="button" value="提交" class="btn btn-primary"/>
	<button onclick="window.location.href='/totoroCrossCalculator'" type="button" value="重置" class="btn"/>重置</button>
</div>
<?php $this->endWidget(); ?>
<div class="row-fluid download" style="padding:30px;">
	<?php $this->widget('application.components.widgets.TpAppdownloadWidget');?>
</div>
<!--comment-->
<div class="row-fluid show_nave">
    <div class="well">
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
</div>


    <script language="javascript">
		function UpdateParentImage(Parent) {
			var GenotypeValueCode;
			GenotypeValueCode = CompileGenotypeValueCode(Parent);
			var Imgid = "#"+Parent+"Image";
			var src = $(Imgid).src = "<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/static/totorocross/" + GenotypeValueCode + ".jpg";
			$(Imgid).attr('src', src);
		}
	
		function CompileGenotypeValueCode(Parent) {
			var x,el,Gene_id;
			var GenotypeValueCode=0;
			for (x=0;x<$("select").length;x++) {
				el=$("select")[x];
				if (el.name.substr(0,Parent.length + 7)==(Parent+ "Gene_id")) {
					Gene_id=el.name.substr(Parent.length + 7);
					GenotypeValueCode += Math.pow(10,parseInt(Gene_id)) * el.value;
				}
			}
			return(GenotypeValueCode);
		}
		
		function CalcGenotype() {
			$("#SireGVC").val(CompileGenotypeValueCode("Sire"));
			$("#DamGVC").val(CompileGenotypeValueCode("Dam"));
			$("#ChinCalc").submit();
		}
		
		//Update the images using a script, so that browsers which don't support script, show the unknown image.
		UpdateParentImage("Sire");
		UpdateParentImage("Dam");
    </script>