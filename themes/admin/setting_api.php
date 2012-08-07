<?php echo $setting_header;?>
<div class="formmain">
<?php echo $setting_nav;?>
<div class="formbox">
  <form action="<?php echo spUrl('admin','setting_api',array('act'=>'save'));?>" method="post" class="form-horizontal" style="padding: 0 20px 0px 20px;">
        <fieldset>
        <legend>淘宝登录及淘宝客接口</legend>
          <div class="control-group">
            <label class="control-label" for="taobao_appkey">APP Key</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="taobao_appkey" name="taobao_appkey" value="<?php echo $api['Taobao']['APPKEY'];?>">
              <p class="help-block">App Key申请地址：http://open.taobao.com 请使用淘宝客应用 否则无法正确获得淘宝客推广链接</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="taobao_appsecret">App Secret</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="taobao_appsecret" name="taobao_appsecret" value="<?php echo $api['Taobao']['APPSECRET'];?>">
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label" for="taobao_callback">App Callback</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="taobao_callback" name="taobao_callback" value="<?php echo $api['Taobao']['CALLBACK']?$api['Taobao']['CALLBACK']:base_url().'index.php?c=callback_taobao';?>">
              <p class="help-block">请在申请APP Key时需要该地址，例如：<?php echo base_url().'index.php?c=callback_taobao';?></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="taobao_pid">淘宝客PID</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="taobao_pid" name="taobao_pid" value="<?php echo $api['Taobao']['PID'];?>">
              <p class="help-block">请只填写PID中的数字部份：如 mm_29948364_0_0 只需要填写：29948364</p>
              <p class="help-block">PID申请地址：http://www.alimama.com</p>
            </div>
          </div>
        <legend>新浪微博登录接口</legend>
          <div class="control-group">
            <label class="control-label" for="sina_appkey">APP Key</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="sina_appkey" name="sina_appkey" value="<?php echo $api['Sina']['APPKEY'];?>">
              <p class="help-block">App Key申请地址：<a href="http://open.weibo.com">http://open.weibo.com</a></p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sina_appsecret">App Secret</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="sina_appsecret" name="sina_appsecret" value="<?php echo $api['Sina']['APPSECRET'];?>"><br />
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label" for="sina_callback">App Callback</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="sina_callback" name="sina_callback" value="<?php echo $api['Sina']['CALLBACK']?$api['Sina']['CALLBACK']:$api_callback.'Sina';?>">
              <p class="help-block">请在申请APP Key时需要该地址，例如：<?php echo $api_callback.'Sina';?></p>
            </div>
          </div>
        <legend>腾讯QQ登录接口</legend>
          <div class="control-group">
            <label class="control-label" for="sina_appkey">APP Key</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="qq_appkey" name="qq_appkey" value="<?php echo $api['QQ']['APPKEY'];?>">
              <p class="help-block">App Key申请地址：http://connect.qq.com</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sina_appsecret">App Secret</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="qq_appsecret" name="qq_appsecret" value="<?php echo $api['QQ']['APPSECRET'];?>"><br />
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label" for="sina_callback">App Callback</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="qq_callback" name="qq_callback" value="<?php echo $api['QQ']['CALLBACK']?$api['QQ']['CALLBACK']:$api_callback.'QQ';?>">
              <p class="help-block">请在申请APP Key时可能需要该地址，例如：<?php echo $api_callback.'QQ';?></p>
            </div>
          </div>
        <legend>人人网登录接口</legend>
          <div class="control-group">
            <label class="control-label" for="sina_appkey">APP Key</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="renren_appkey" name="renren_appkey" value="<?php echo $api['Renren']['APPKEY'];?>">
              <p class="help-block">App Key申请地址：http://dev.renren.com/</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sina_appsecret">App Secret</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="renren_appsecret" name="renren_appsecret" value="<?php echo $api['Renren']['APPSECRET'];?>"><br />
            </div>
          </div>          
          <div class="control-group">
            <label class="control-label" for="sina_callback">App Callback</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="renren_callback" name="renren_callback" value="<?php echo $api['Renren']['CALLBACK']?$api['Renren']['CALLBACK']:$api_callback.'Renren';?>">
              <p class="help-block">请在申请APP Key时可能需要该地址，<?php echo $api_callback.'Renren';?></p>
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
