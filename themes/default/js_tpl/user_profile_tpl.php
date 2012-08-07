<script id="user_profile_tpl" type="text/template">
	<b class="arrow_t"><i class="arrow_inner_t"></i></b>
    {{#success}}
	{{#data}}
    <div class="info">
        <a href="{{user.home}}" target="_blank" class="avatar"><img src="{{user.avatar}}" width="50" height="50" /></a>
        <p><b><a href="{{user.home}}" target="_blank">{{user.nickname}} {{user.group_title}}</a></b></p>
		<p><a href="{{user.home}}" target="_blank">{{user.credits.name}}:{{user.credits.value}}</a><a href="{{user.home}}" target="_blank">{{user.ext_credits_1.name}}:{{user.ext_credits_1.value}}</a><a href="{{user.home}}" target="_blank">{{user.ext_credits_2.name}}:{{user.ext_credits_2.value}}</a><a href="{{user.home}}" target="_blank">{{user.ext_credits_3.name}}:{{user.ext_credits_3.value}}</a></p>
        <p class="meta"><a href="{{user.home}}" target="_blank"><?php echo T('follow');?>{{user.total_follows}}</a><em class="dot">●</em><a href="{{user.home}}" target="_blank">{{user.total_followers}}<?php echo T('fans');?></a><em class="dot">●</em><a href="{{user.home}}" target="_blank">{{user.total_albums}}<?php echo T('album');?></a><em class="dot">●</em><a href="{{user.home}}" target="_blank">{{user.total_shares}}<?php echo T('share');?></a></p>
    </div>
    <div class="mark_list">
    {{#shares}}
    <a href="{{link}}" target="_blank"><img src="<?php echo base_url();?>{{image_path}}_square.jpg" title="{{title}}" /></a>
    {{/shares}}
    </div>
    <div class="operate">
        {{{relation}}}
    </div>
	{{/data}}
    {{/success}}
    {{^success}}
    <p class="message">{{{message}}}</p>
    {{/success}}

    <b class="arrow_b"><i class="arrow_inner_b"></i></b>
</script>