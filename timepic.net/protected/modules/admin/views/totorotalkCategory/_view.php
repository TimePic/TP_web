<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('catid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->catid),array('view','id'=>$data->catid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upid')); ?>:</b>
	<?php echo CHtml::encode($data->upid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catname')); ?>:</b>
	<?php echo CHtml::encode($data->catname); ?>
	<br />


</div>