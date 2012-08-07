<?php echo $tpl_header; ?>
<?php echo $tpl_user_banner; ?>
<div class="main mt10">
	<div class="g960 timeline-box mb30" id="timeline-box">
		<div class="line" data-action="openPublishSelectDialog">
			<div class="plus"></div>
		</div>
		<?php echo $tpl_timeline; ?>
		
	</div>
</div>
<div class="clear"></div>
<div class="main">
	<div id="timeline-loadingPins" class="g960 text_c"><img src="<?php echo base_url()?>assets/img/ajax-loader.gif" alt="<?php echo T('loading')?>"></div>
</div>
<?php echo $tpl_footer; ?>
