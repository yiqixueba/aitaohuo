<?php echo $setting_header;?>
<div class="tablebox_header">   
<form action="<?php echo spUrl('admin','goodshop_list', array('act'=>'search'));?>" method="get" class=" form-search pull-right">
        <input type="text" name="keyword" class="input-medium search-query">
        <button type="submit" class="btn">搜索</button>
</form>
</div>
<div class="tablebox">
   <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th><?php echo T('email');?></th>
            <th><?php echo T('th_username');?></th>
            <th><?php echo T('th_user_title');?></th>
            <th><?php echo T('category');?></th>
            <th><?php echo T('th_user_desc');?></th>
            <th><?php echo T('goodshop_description');?></th>
            <th><?php echo T('th_type');?></th>
            <th><?php echo T('displayorder');?></th>
            <th><?php echo T('create_time');?></th>
            <th><?php echo T('th_operation');?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($goodshops as $u):?>
          <tr>
            <td><?php echo $u['shop_id'];?></td>
            <td width="100"><?php echo $u['email'];?></td>
            <td width="100"><?php echo $u['nickname'];?></td>
            <td width="150"><?php echo $u['user_title'];?></td>
            <td width="100"><?php echo $u['category_name_cn'];?></td>
            <td style="word-wrap:break-word;width:300px;"><?php echo $u['bio'];?></td>
            <td style="word-wrap:break-word;width:300px;"><?php echo $u['shop_desc'];?></td>
            <td width="100"><?php echo T('goodshop');?></td>
            <td width="100"><?php echo $u['display_order'];?></td>
            <td width="100"><?php echo friendlyDate($u['create_time']);?></td>
            <td width="100">
            <a href="<?php echo spUrl('admin','goodshop_list',array('act'=>'edit','shopid'=>$u['shop_id']));?>"><?php echo T('edit');?></a>
            <a href="<?php echo spUrl('admin','goodshop_list',array('act'=>'delete','shopid'=>$u['shop_id']));?>"><?php echo T('delete');?></a>
            </td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
      
<?php echo $pages;?>
</div>

</body>
</html>