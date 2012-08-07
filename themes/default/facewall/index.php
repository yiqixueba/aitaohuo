<?php echo $tpl_header; ?>
<div class="main" id="waterfall_outer" data-fullscreen="<?php echo $settings['ui_layout']['face_auto']?1:0;?>">
	<div class="g960 mb30 friend_list" id="waterfall" data-pin-width="204">
		<?php echo $tpl_waterfall; ?>
	</div>
</div>
<div class="clear"></div>
<div class="main">
	<div id="loadingPins" class="g960 text_c"><img src="<?php echo base_url()?>assets/img/ajax-loader.gif" alt="<?php echo T('loading');?>"></div>
</div>
<div id="page-nav" class="mt20 main of_h">
	<a id="page-next" href="<?php echo $nextpage_url; ?>"></a>
</div>
<?php echo $tpl_footer; ?>
