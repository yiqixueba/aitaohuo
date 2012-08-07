<span class="<?php echo $relation['friend_id'].'-relation';?>">
<?php if($relation['status'] == 0):?>
<a href="javascript:void(0);" data-action="addFollow" data-params="<?php echo $relation['friend_id'];?>" class="relation-box"><?php echo T('add_follow');?></a>
<?php elseif($relation['status'] == 1): ?>
<a href="javascript:void(0);" data-action="removeFollow" data-params="<?php echo $relation['friend_id'];?>" class="relation-box">
	<?php if($is_shop):?>
	<span class="view"><?php echo T('already_collect');?></span>
	<span class="action"><?php echo T('cancel_collect');?></span>
	<?php else:?>
	<span class="view"><?php echo T('already_followed');?></span>
	<span class="action"><?php echo T('cancel_follow');?></span>
	<?php endif;?>
</a>
<?php elseif($relation['status'] == 2): ?>
<a href="javascript:void(0);" data-action="addFollow" data-params="<?php echo $relation['friend_id'];?>" class="relation-box">
	<?php if($is_shop):?>
	<span class="view"><?php echo T('he_follow_you');?></span>
	<span class="action"><?php echo T('collect_goodshop');?></span>
	<?php else:?>
	<span class="view"><?php echo T('he_follow_you');?></span>
	<span class="action"><?php echo T('add_follow');?></span>
	<?php endif;?>
</a>
<?php elseif($relation['status'] == 3): ?>
<a href="javascript:void(0);" data-action="removeFollow" data-params="<?php echo $relation['friend_id'];?>" class="relation-box">
	<span class="view"><?php echo T('follow_together');?></span>
	<span class="action"><?php echo T('cancel_follow');?></span>
</a>
<?php else: ?>
<a href="javascript:void(0);" class="relation-box">
	<?php echo T('myself');?>
</a>
<?php endif;?>
</span>