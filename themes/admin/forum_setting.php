<?php echo $setting_header;?>
<div class="formmain">
<?php echo $forum_nav;?>
<div class="formbox">
	<div class="alert alert-danger">
	    <strong>警告!</strong> 为了安全起见，修改完毕后，请将根目录下config.php文件属性设置为644。建议您直接修改config.php。
	</div>
  <form action="<?php echo spUrl('admin','forum_setting',array('act'=>'save'));?>" method="post" class="form-horizontal settingform">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="open_forumline">打开论坛生涯</label>
            <div class="controls">
              <input type="radio" name="open_forumline" class="input-xlarge" value="1" <?php echo $vsettings['open_forumline']?'checked':'';?>>是</input>
              <input type="radio" name="open_forumline" class="input-xlarge" value="0" <?php echo !$vsettings['open_forumline']?'checked':'';?>>否</input>
              <p class="help-block">是否打开论坛生涯...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbhost">论坛域名</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="bbs_domain" name="bbs_domain" value="<?php echo $vsettings['bbs_domain'];?>">
               <p class="help-block">请输入您的论坛域名，后面不要加/...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbhost">数据库地址</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="bbs_dbhost" name="bbs_dbhost" value="<?php echo $vsettings['bbs_dbhost'];?>">
               <p class="help-block">论坛数据库地址，默认localhost...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbname">数据库名</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="bbs_dbname" name="bbs_dbname" value="<?php echo $vsettings['bbs_dbname'];?>">
               <p class="help-block">论坛数据库地址...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbpre">数据库表前缀</label>
            <div class="controls">
             <input type="text"  class="input-xlarge" id="bbs_dbpre" name="bbs_dbpre" value="<?php echo $vsettings['bbs_dbpre'];?>">
             <p class="help-block">论坛数据库表前缀...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbuser">数据库用户名</label>
            <div class="controls">
             <input type="text"  class="input-xlarge" id="bbs_dbuser" name="bbs_dbuser" value="<?php echo $vsettings['bbs_dbuser'];?>">
             <p class="help-block">论坛数据库用户名,请使用和拼图秀不同的用户访问论坛数据库...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="bbs_dbpassword">数据库密码</label>
            <div class="controls">
             <input type="text"  class="input-xlarge" id="bbs_dbpassword" name="bbs_dbpassword" value="<?php echo $vsettings['bbs_dbpassword'];?>">
             <p class="help-block">论坛数据库密码</p>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">确定</button> 
          </div>
        </fieldset>
      </form>
</div>
</div>
</div>
</body>
</html>
