<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sampleid),array('view','id'=>$data->sampleid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateline')); ?>:</b>
	<?php echo CHtml::encode($data->dateline); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('displayorder')); ?>:</b>
	<?php echo CHtml::encode($data->displayorder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cardid')); ?>:</b>
	<?php echo CHtml::encode($data->cardid); ?>
	<br />


</div>