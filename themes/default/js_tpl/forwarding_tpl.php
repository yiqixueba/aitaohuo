<script type="text/template" id="forwarding_tpl" data-title="<?php echo T('edit').' '.T('forward');?>" data-edit-title="<?php echo T('edit').' '.T('forward');?>">
{{#data}}
	<div class="pin_form">
		<div class="left">
			<div class="image mt10">
				<div><b><img src="<?php echo base_url()?>{{share.image_path}}_middle.jpg"></b><i class="cover"><?php echo T('cover');?></i></div>
        	</div>
		</div>
		<div class="right" id="forwarding_div" data-uid="{{share.user_id}}">
				<div>
       				{{share.title}}
            	</div>
				<div class="btn_select mt10 category_select_list first_div" data-init="0" data-find-album="1">
					<a href="javascript:void(0);" class="listbtn" data-action="categoryItemPopup" data-params="forwarding_div"><span class="label"><?php echo T('category');?>：</span><span class="category_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
               		<ul>
                	</ul>
                	<input name="category_id" type="hidden" class="category_select_id">
            	</div>
 				<div class="btn_select mt10 album_select_list second_div" data-init="0" data-album-id="{{share.album_id}}" data-album-name="{{share.album_title}}">
					<a href="javascript:void(0);" class="listbtn" data-action="albumItemPopup" data-params="forwarding_div"><span class="label"><?php echo T('album');?>：</span><span class="album_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
                	<ul>
                    	<li class="create_board" data-id="create_board">
                        	<input type="text" class="album_name" data-id="album_name">
                        	<button class="album_select_create" type="button" data-action="albumPopCreate" data-params="forwarding_div"><?php echo T('create_new').T('album');?></button>
                    	</li>
               		</ul>
            		<input class="album_select_id" name="album_id" type="hidden">
            	</div>
				
				<div id="ajax_share_message" class="error"></div>
				<div class="mt10 text_c">
					<button data-action="forwardingSave"><?php echo T('submit');?></button>
				</div>
		</div>
    </div>
{{/data}}
</script>
<script type="text/template" id="item_edit_tpl" data-title="<?php echo T('edit').T('share');?>" data-edit-title="<?php echo T('edit').T('share');?>">
{{#data}}
	<div class="publish_form">
			<div class="left">
				<div class="image mt10">
					<a href="javascript:void(0);" class="prev disabled"
						data-action="preImage" id="preImageBtn"><i></i>1</a>
					<div>
						<b id="upload_imgview_div"><img src="<?php echo base_url()?>{{share.image_path}}_middle.jpg?{{share.random}}"></b><i class="cover"><?php echo T('cover');?></i>
					</div>
					<a href="javascript:void(0);" class="next disabled"
						data-action="nextImage" id="nextImageBtn">2<i></i> </a>
				</div>
			</div>
			<div class="right" id="item_detail_div" data-uid="{{share.user_id}}">
				<form id="edit_share_form" method="post" next-url="<?php echo spUrl('my','shares');?>">
					<input type="hidden" name="cover_filename" id="cover_filename">
					<input type="hidden" name="all_files" id="all_files">
       				<input type="hidden" name="share_id" value="{{share.share_id}}"/>

					<div class="form_line">
						<div class="form_item">
							<input type="text" name="title" id="title" title="<?php echo T('share_title');?>" value="{{share.title}}">
						</div>
						<div class="form_item">
							<input type="text" name="price" id="price" title="<?php echo T('share_price');?>" value="{{share.price}}">
						</div>
					</div>
					<div class="clear"></div>
					<div class="form_line first_div">
						<div class="form_item first_div">
							<div class="btn_select first_div category_select_list" data-init="0" data-find-album="1">
			                	<input id="category_select_id" name="category_id" type="hidden" class="category_select_id">
								<a href="javascript:void(0);" class="listbtn" data-action="categoryItemPopup" data-params="item_detail_div"><span class="label"><?php echo T('category');?>：</span><span class="category_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
			               		<ul>
			                	</ul>
			            	</div>
						</div>
						<div class="form_item second_div">
							<div class="btn_select second_div album_select_list" data-init="0" data-album-id="{{share.album_id}}" data-album-name="{{share.album_title}}">
			            		<input class="album_select_id" name="album_id" type="hidden">
								<a href="javascript:void(0);" class="listbtn" data-action="albumItemPopup" data-params="item_detail_div"><span class="label"><?php echo T('album');?>：</span><span class="album_select_title"><?php echo T('loading');?></span><s><b></b></s></a>
			                	<ul>
			                    	<li class="create_board" data-id="create_board">
			                        	<input type="text" class="album_name" data-id="album_name">
			                        	<button class="album_select_create" type="button" data-action="albumPopCreate" data-params="item_detail_div"><?php echo T('create_new').T('album');?></button>
			                    	</li>
			               		</ul>
			            	</div>
						</div>
					</div>
					<div class="form_line">
						<input type="text" name="promotion_url" id="promotion_url" title="<?php echo T('promotion_url');?>" value="{{share.promotion_url}}"/>
					</div>
					<div class="clear"></div>
					<div class="form_textarea third_div">
						<div class="form_textarea_hd">
						<div class="btn-group icon_div third_div" id="edit_smiles_div">
						<a href="javascript:;" class="smile dropdown-toggle" id="smiles" data-toggle="dropdown">Smilies</a>
						<ul class="dropdown-menu smiles" data-init="0">
				        </ul>
				        </div>
						<a href="javascript:;" class="at" onclick="javascript:$('#edit_publish_intro').insertAtCaret('@<?php echo T('friend');?> ',1);">@</a>
						<div class="btn-group" id="tags_div">
							<a href="javascript:;" class="box dropdown-toggle" data-toggle="dropdown"><?php echo T('hot').' '.T('tag');?></a>
							<ul class="dropdown-menu tags_list" data-target-id="edit_publish_intro">
				        	</ul>
				        </div>
						<a href="javascript:;" class="box" style="display:none;" onclick="javascript:$('#edit_publish_intro').insertAtCaret('#话题#',1);">#话题#</a>
						</div>
						<textarea id="edit_publish_intro" rows="2" name="intro">{{share.intro}}</textarea>
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
						{{#share.images}}
							<li data-action="publishPinItem" data-id="{{id}}" data-url="{{url}}" class="selected {{#cover}}cover{{/cover}}"><b><img src="<?php echo base_url();?>{{url}}_large.jpg?{{share.random}}"/></b><i></i><input type="text" value="{{desc}}" name="desc" placeholder="<?php echo T('type_some');?>"/></li>
						{{/share.images}}
					</ul>
				</div>
			</div>
	</div>
{{/data}}
</script>