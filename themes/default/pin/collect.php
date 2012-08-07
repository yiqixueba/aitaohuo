<?php echo $tpl_header; ?>
<div id="ui_push_dialog" class="ui-dialog dialog_tools dialog_upload" style="width: 750px; opacity: 1; top: 0px; left: 0px; "><div class="hd"><?php echo T('create_new').T('share');?></div><div class="bd">
	<div class="publish_form">
			<div class="left">
				<div class="image mt10">
					<a href="javascript:void(0);" class="prev disabled"
						data-action="preImage" id="preImageBtn"><i></i>1</a>
					<div>
						<b id="upload_imgview_div"></b><i class="cover"><?php echo T('cover');?></i>
					</div>
					<a href="javascript:void(0);" class="next disabled"
						data-action="nextImage" id="nextImageBtn">2<i></i> </a>
				</div>
			</div>
			<div class="right" id="category_select_div" data-uid="<?php echo $current_user['user_id'];?>">
				<form id="save_share_form" data-url="<?php echo spUrl('share','item_fetch', array('act'=>'save'));?>" next-url="<?php echo spUrl('pin','index');?>" method="post">
					<input type="hidden" name="cover_filename" id="cover_filename"> 
					<input type="hidden" name="item_id" id="item_id"> 
					<input type="hidden" name="channel" id="channel" value="others"> 
					<input type="hidden" name="share_type" id="share_type" value="images"> 
					<input type="hidden" name="reference_url" id="reference_url"> 
					<input type="hidden" name="all_files" id="all_files">

					<div class="form_line">
						<div class="form_item">
							<input type="text" name="title" id="title" title="<?php echo T('share_title');?>">
						</div>
						<div class="form_item">
							<input type="text" name="price" id="price" title="<?php echo T('share_price').T('not_required');?>">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form_line first_div">
						<div class="form_item first_div">
							<div class="btn_select first_div category_select_list" data-init="0" data-find-album="1">
			                	<input id="category_select_id" name="category_id" type="hidden" class="category_select_id">
								<a href="javascript:;" class="listbtn" data-action="categoryItemPopup" data-params="category_select_div"><span class="label"><?php echo T('category');?>：</span><span class="category_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
			               		<ul>
			                	</ul>
			            	</div>
						</div>
						<div class="form_item second_div">
							<div class="btn_select second_div album_select_list" data-init="0">
			            		<input class="album_select_id" name="album_id" type="hidden">
								<a href="javascript:;" class="listbtn" data-action="albumItemPopup" data-params="category_select_div"><span class="label"><?php echo T('album');?>：</span><span class="album_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
			                	<ul>
			                    	<li class="create_board" data-id="create_board">
			                        	<input type="text" class="album_name" data-id="album_name">
			                        	<button class="album_select_create" type="button" data-action="albumPopCreate" data-params="category_select_div"><?php echo T('create_new').T('album');?></button>
			                    	</li>
			               		</ul>
			            	</div>
						</div>
					</div>
					<div class="form_line">
						<input type="text" name="promotion_url" id="promotion_url" title="<?php echo T('promotion_url').T('not_required');?>" />
					</div>
					<div class="clear"></div>
					<div class="form_textarea third_div">
						<div class="form_textarea_hd">
						<div class="btn-group icon_div third_div" id="smiles_div">
						<a href="javascript:;" class="smile dropdown-toggle" id="smiles" data-toggle="dropdown">Smilies</a>
						<ul class="dropdown-menu smiles" data-init="0">
				        </ul>
				        </div>
						<a href="javascript:;" class="at" onclick="javascript:$('#publish_intro').insertAtCaret('@<?php echo T('friend');?> ',1);">@</a>
						<div class="btn-group" id="tags_div">
							<a href="javascript:;" class="box dropdown-toggle" data-toggle="dropdown"><?php echo T('hot').T('tag');?></a>
							<ul class="dropdown-menu tags_list">
				        	</ul>
				        </div>
						<a href="javascript:;" class="box" style="display:none;" onclick="javascript:$('#publish_intro').insertAtCaret('#话题#',1);">#话题#</a>
						</div>
						<textarea id="publish_intro" rows="2" name="intro"></textarea>
					</div>
					
					<div class="clear"></div>
					<div id="ajax_share_message" class="error"></div>
					<div class="form_line text_c">
						<button type="submit"><?php echo T('submit');?></button>
					</div>
					<div class="clear"></div>
				</form>
				<div class="clear"></div>
			</div>
			<div class="one_line">
				<div class="image_list mt10">
					<ul id="publish_image_list">
						<?php foreach ($images as $img):?>
							<li class="selected" data-action="publishPinItem" data-name="<?php echo $img['src'];?>"><b><img src="<?php echo $img['src'];?>"/></b><i></i><input type="text" name="desc" placeholder="说点什么吧"/></li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
</div></div>
<a href="javascript:void(0);" id="collect_getcategory_click" data-action="listCategories" data-params="category_select_div" style="display: none;">111</a>
<a href="javascript:void(0);" id="collect_getsmiles_click" data-action="listSmiles" data-params="smiles_div,publish_intro" style="display: none;">1222</a>
<script type="text/javascript"> 
$(document).ready(function($) {
	 $("#collect_getcategory_click").click();
	 $("#collect_getsmiles_click").click();
	 $("#nextImageBtn").click();
});
 </script> 
<?php echo $tpl_footer; ?>
