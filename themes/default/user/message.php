<?php echo $tpl_header; ?>
<?php echo $tpl_user_banner; ?>
<div class="main">
	<div class="g240 scroll-container">
	<?php echo $tpl_usercontrol;?>
	</div>
	
	<div class="g720 right-content white_bg mb30 mt20">
		<div class="page-header">
			<h5><?php echo T('tip_message_list')?></h5>
  		</div>
  		<div class="page-content">
  			<div class="messages">
              <ul class="ms_list">
              	<?php foreach ($messages as $message):?>
              	<li class="list_info hide" id="comment_20" style="display: list-item; "> 
					<a class="img_face" href="javascript:void(0);"><img src="<?php echo useravatar($message['from_user_id'], 'middle')?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_small.jpg';" width="30" height="30"></a>
			    	<p>
					<span><a href="<?php echo spUrl('pub','index',array('uid'=>$message['from_user_id']));?>"><?php echo $message['nickname'];?></a></span>
					<span class="cgray f_r"><?php echo friendlyDate($message['create_time']);?></span>
					</p>
					<p class="tj"><?php echo $message['message_txt'];?></p>
				</li>
				<?php endforeach;?>
              </ul>
            </div>
    	</div>
	</div>
</div>

<?php echo $tpl_footer; ?>
