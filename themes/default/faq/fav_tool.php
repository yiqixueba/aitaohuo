<?php echo $tpl_header; ?>
<div class="clear"></div>
<script src="<?php echo base_url();?>assets/js/tools.js" type="text/javascript"></script>
<div class="main mt20">
	<div class="g960 round-shadow white_bg faq">
		<h2>
			<?php echo T('drag_to_bookmark');?> <a id="fav-tool-btn" class="fav_tool bookmarklet" href="javascript:void(function(g,d,m,s){g[m]?(g[m].c=1,g[m]()):!d[m]&&(d.getElementsByTagName('head')[0]||d.body).appendChild((d[m]=1,s=d.createElement('script'),s.setAttribute('charset','utf-8'),s.id='pinit-script',s.src='<?php echo base_url();?>assets/js/pincollect.js?'+Math.floor(+new Date/10000000),s))}(window,document,'__pinit'))" title="<?php echo T('soft_name');?>"><?php echo T('tool_btn_txt');?></a>
		</h2>
		<div class="category-bd mt10 mb20">
		<?php echo $fav_nav; ?>
			<div class="g800 inside">
				<div class="block" id="not-ie" style="display: block;">
					<p>
						<em class="number">1.</em><strong><?php echo T('tool_btn_tip_1');?></strong>
					</p>

					<p>
						<img src="<?php echo base_url();?>assets/img/chrome-1.png">
					</p>

					<br>

					<p>
						<em class="number">2.</em><strong><?php echo T('tool_btn_tip_2');?></strong>
					</p>
					<div class="view">
						<a id="fav-tool-btn" class="fav_tool bookmarklet"
						href="javascript:void(function(g,d,m,s){g[m]?(g[m].c=1,g[m]()):!d[m]&&(d.getElementsByTagName('head')[0]||d.body).appendChild((d[m]=1,s=d.createElement('script'),s.setAttribute('charset','utf-8'),s.id='pinit-script',s.src='<?php echo base_url();?>assets/js/pincollect.js?'+Math.floor(+new Date/10000000),s))}(window,document,'__pinit'))"
						title="<?php echo T('soft_name');?>"><?php echo T('tool_btn_txt');?></a>
							<em>←</em><b><?php echo T('drag_to_bookmark');?></b>
					</div>
					<br>

					<p>
						<em class="number">3.</em><strong><?php echo T('tool_btn_tip_3');?></strong>
					</p>

					<p>
						<img src="<?php echo base_url();?>assets/img/chrome-2.png">
					</p>
					<br>

				</div>


				<div class="block" id="ie" style="display: none;">
					<p>
						<em class="number">1.</em><strong><?php echo T('tool_btn_tip_1');?></strong>
					</p>

					<div class="view">
						
						<a id="fav-tool-btn" class="fav_tool bookmarklet"
						href="javascript:void(function(g,d,m,s){g[m]?(g[m].c=1,g[m]()):!d[m]&&(d.getElementsByTagName('head')[0]||d.body).appendChild((d[m]=1,s=d.createElement('script'),s.setAttribute('charset','utf-8'),s.id='pinit-script',s.src='<?php echo base_url();?>assets/js/pincollect.js?'+Math.floor(+new Date/10000000),s))}(window,document,'__pinit'))"
						title="<?php echo T('soft_name');?>"><?php echo T('tool_btn_txt');?></a>

						<b>
							<em>←</em><?php echo T('tool_btn_ie_tip_1');?>
						</b>

					</div>
					<p><?php echo T('tool_btn_ie_tip_2');?></p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo T('tool_btn_ie_tip_3');?></p>
					<p>
						<img src="<?php echo base_url();?>assets/img/ie-1.png">
					</p>
					<br>

					<p>
						<em class="number">2.</em><strong><?php echo T('tool_btn_tip_1');?></strong>
					</p>

					<p>
						<img src="<?php echo base_url();?>assets/img/ie-2.png">
					</p>
					<br>

					<p>
						<em class="number">3.</em><strong><?php echo T('tool_btn_tip_3');?></strong>
					</p>

					<p>
						<img src="<?php echo base_url();?>assets/img/ie-3.png">
					</p>
					<br>
				</div>
				
			</div>
		</div>
	</div>
</div>

		<?php echo $tpl_footer; ?>