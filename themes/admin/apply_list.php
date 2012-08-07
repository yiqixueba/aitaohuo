<?php echo $setting_header;?>
<div class="tablebox">
   <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th><?php echo T('th_username');?></th>
            <th><?php echo T('th_type');?></th>
            <th><?php echo T('th_category');?></th>
            <th><?php echo T('th_reason');?></th>
            <th><?php echo T('th_status');?></th>
            <th><?php echo T('th_operation');?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($applys as $u):?>
          <tr>
            <td style="word-wrap:break-word;width:50px;"><?php echo $u['apply_id'];?></td>
            <td style="word-wrap:break-word;width:100px;"><?php echo $u['nickname'];?></td>
            <td style="word-wrap:break-word;width:50px;"><?php echo $u['apply_type']==1?T('staruser'):T('goodshop');?></td>
            <td style="word-wrap:break-word;width:100px;"><?php echo $u['category_name_cn'];?></td>
            <td style="word-wrap:break-word;width:300px;"><?php echo $u['message_txt'];?></td>
            <td style="word-wrap:break-word;width:80px;"><?php echo $u['status']?T('already_agree'):T('wait_verify');?></td>
            <td style="word-wrap:break-word;width:80px;"><a href="<?php echo spUrl('admin','apply_list',array('act'=>'agreen','applyid'=>$u['apply_id']));?>"><?php echo T('operation_agree');?></a> <a href="<?php echo spUrl('admin','apply_list',array('act'=>'disagree','applyid'=>$u['apply_id']));?>"><?php T('operation_decline');?></a></td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
      
<?php echo $pages;?>
</div>

</body>
</html>