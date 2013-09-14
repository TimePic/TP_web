<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tagid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tagid),array('view','id'=>$data->tagid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tagname')); ?>:</b>
	<?php echo CHtml::encode($data->tagname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aliasWords')); ?>:</b>
	<?php echo CHtml::encode($data->aliasWords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>