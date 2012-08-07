<?php echo $setting_header;?>
<div class="tablebox_header">   
<form action="<?php echo spUrl('admin','staruser_list', array('act'=>'search'));?>" method="get" class=" form-search pull-right">
        <input type="text" name="keyword" class="input-medium search-query">
        <button type="submit" class="btn"><?php echo T('search');?></button>
</form>
</div>
<div class="tablebox">
   <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>email</th>
            <th><?php echo T('th_username');?></th>
            <th><?php echo T('th_user_title');?></th>
            <th><?php echo T('category');?></th>
            <th><?php echo T('th_user_desc');?></th>
            <th><?php echo T('recommend_reason');?></th>
            <th><?php echo T('th_type');?></th>
            <th><?php echo T('create_time');?></th>
            <th><?php echo T('th_operation');?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($starusers as $u):?>
          <tr>
            <td><?php echo $u['star_id'];?></td>
            <td width="100"><?php echo $u['email'];?></td>
            <td width="100"><?php echo $u['nickname'];?></td>
            <td width="150"><?php echo $u['user_title'];?></td>
            <td width="100"><?php echo $u['category_name_cn'];?></td>
            <td style="word-wrap:break-word;width:300px;"><?php echo $u['bio'];?></td>
            <td style="word-wrap:break-word;width:300px;"><?php echo $u['star_reason'];?></td>
            <td width="100"><?php echo T('staruser');?></td>
            <td width="100"><?php echo friendlyDate($u['create_time']);?></td>
            <td width="100">
            <a href="<?php echo spUrl('admin','staruser_list',array('act'=>'edit','starid'=>$u['star_id']));?>"><?php echo T('edit');?></a>
            <a href="<?php echo spUrl('admin','staruser_list',array('act'=>'delete','starid'=>$u['star_id']));?>"><?php echo T('delete');?></a>
            </td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
      
<?php echo $pages;?>
</div>

</body>
</html>