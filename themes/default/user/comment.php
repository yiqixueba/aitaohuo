<?php echo $tpl_header; ?>
<?php echo $tpl_user_banner; ?>
<div class="main">
	<div class="g240 scroll-container">
	<?php echo $tpl_usercontrol;?>
	</div>
	
	<div class="g720 right-content white_bg mb30 mt20">
		<div class="page-header">
			<h5>@<?php echo T('my_comment')?></h5>
  		</div>
  		<div class="page-content">
  			<div class="at_comments">
              <ul class="ms_list">
              	<?php foreach ($comments as $comment):?>
              	<li class="list_info hide" id="comment_20" style="display: list-item; "> 
					<a class="img_face" href="<?php echo spUrl('pub','index',array('uid'=>$comment['user_id']));?>"><img src="<?php echo useravatar($comment['user_id'], 'middle')?>" onerror="javascript:this.src = base_url + '/assets/img/avatar_small.jpg';" width="30" height="30"></a>
			    	<p>
					<span><a href="<?php echo spUrl('pub','index',array('uid'=>$comment['user_id']));?>"><?php echo $comment['nickname'];?>：</a><?php echo parse_message($comment['comment_txt']);?></span>
					<span class="cgray"><?php echo friendlyDate($comment['create_time']);?></span>
					</p>
					<p class="tj cgray"><?php echo T('comment')?> <a href="<?php echo spUrl('pub','index',array('uid'=>$comment['share_user_id']));?>"><?php echo $comment['share_user_nickname'];?></a> <?php echo T('share');?> 
					<a href="<?php echo spUrl("detail","index", array("share_id"=> $comment['share_id']));?>"><?php echo sysSubStr($comment['item_intro'],1000);?></a></p>
				</li>
				<?php endforeach;?>
              </ul>
            </div>
           
    	</div>
    	<div class="g720 text_c"><?php echo $pages;?></div>
	</div>
</div>

<?php echo $tpl_footer; ?>
