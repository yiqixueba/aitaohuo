<?php echo $setting_header;?>
<div class="formmain">
<?php echo $forum_nav;?>
<div class="formbox">
  <div class="alert alert-danger">
	    <strong>警告!</strong> 为了安全起见，修改完毕后，请将根目录下config.php文件属性设置为644。建议您直接修改config.php。
	</div>
  <form action="<?php echo spUrl('admin','ucenter_setting',array('act'=>'save'));?>" method="post" class="form-horizontal settingform">
        <fieldset>
          <div class="control-group">
            <label class="control-label" for="ucenter_open">打开ucenter</label>
            <div class="controls">
              <input type="radio" name="ucenter_open" class="input-xlarge" value="1" <?php echo $vsettings['ucenter_open']?'checked':'';?>>是</input>
              <input type="radio" name="ucenter_open" class="input-xlarge" value="0" <?php echo !$vsettings['ucenter_open']?'checked':'';?>>否</input>
              <p class="help-block">是否打开ucenter...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_domain">ucenter地址</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_domain" name="ucenter_domain" value="<?php echo $vsettings['ucenter_domain'];?>">
               <p class="help-block">请输入您的ucenter地址，后面不要加/...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_dbhost">数据库地址</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_dbhost" name="ucenter_dbhost" value="<?php echo $vsettings['ucenter_dbhost'];?>">
               <p class="help-block">ucenter数据库地址，默认localhost...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_dbname">数据库名</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_dbname" name="ucenter_dbname" value="<?php echo $vsettings['ucenter_dbname'];?>">
               <p class="help-block">ucenter数据库地址...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_dbpre">数据库表前缀</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_dbpre" name="ucenter_dbpre" value="<?php echo $vsettings['ucenter_dbpre'];?>">
               <p class="help-block">ucenter数据库表前缀...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_dbuser">数据库用户名</label>
            <div class="controls">
             <input type="text"  class="input-xlarge" id="ucenter_dbuser" name="ucenter_dbuser" value="<?php echo $vsettings['ucenter_dbuser'];?>">
             <p class="help-block">ucenter数据库用户名...</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_dbpassword">数据库密码</label>
            <div class="controls">
             <input type="text"  class="input-xlarge" id="ucenter_dbpassword" name="ucenter_dbpassword" value="<?php echo $vsettings['ucenter_dbpassword'];?>">
             <p class="help-block">ucenter数据库密码</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_appid">ucenter应用ID</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_appid" name="ucenter_appid" value="<?php echo $vsettings['ucenter_appid'];?>">
               <p class="help-block">ucenter应用ID APPID</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="ucenter_appkey">ucenter通信密匙</label>
            <div class="controls">
              <input type="text"  class="input-xlarge" id="ucenter_appkey" name="ucenter_appkey" value="<?php echo $vsettings['ucenter_appkey'];?>">
               <p class="help-block">ucenter通信密匙...</p>
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
