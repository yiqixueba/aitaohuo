<ul class="faq_nav g160">
    <li <?php echo ($current_action == 'fav')?'class="selected"':'';?>><a href="<?php echo spUrl('faq','fav');?>"> &gt; <?php echo T('collect_tool');?></a></li>
    <li <?php echo ($current_action == 'agreement')?'class="selected"':'';?>><a href="<?php echo spUrl('faq','agreement');?>"> &gt; <?php echo T('agreement');?></a></li>
    <li <?php echo ($current_action == 'about_us')?'class="selected"':'';?>><a href="<?php echo spUrl('faq','about_us');?>"> &gt; <?php echo T('about_us');?></a></li>
    <li <?php echo ($current_action == 'contact_us')?'class="selected"':'';?>><a href="<?php echo spUrl('faq','contact_us');?>"> &gt; <?php echo T('contact_us');?></a></li>
</ul>