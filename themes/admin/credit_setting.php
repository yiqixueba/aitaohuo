<?php echo $setting_header;?>
<div class="formmain">
<?php echo $credit_setting_nav;?>
<script type="text/JavaScript">
$.fn.extend({
	insertAtCaret : function(myValue, needSelect) {
		return this.each(function(i) {
			if (document.selection) {
				// For browsers like Internet Explorer
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				if (needSelect) {
					sel.moveStart("character", -(myValue.length - 1));
					sel.moveEnd("character", -1);
					sel.select();
				}
			} else if (this.selectionStart || this.selectionStart == '0') {
				// For browsers like Firefox and Webkit based
				var startPos = this.selectionStart;
				var endPos = this.selectionEnd;
				var scrollTop = this.scrollTop;
				this.value = this.value.substring(0, startPos) + myValue
						+ this.value.substring(endPos, this.value.length);
				this.focus();

				if (needSelect) {
					this.selectionStart = startPos + 1;
					this.selectionEnd = startPos + myValue.length - 1;
				} else {
					this.selectionStart = startPos + myValue.length;
					this.selectionEnd = startPos + myValue.length;
				}
				this.scrollTop = scrollTop;
			} else {
				this.value += myValue;
				this.focus();
			}
		});
	}
});
	function isUndefined(variable) {
		return typeof variable == 'undefined' ? true : false;
	}
	function insertunit(text) {
		var credit_formula = $('#credit_formula');
		credit_formula.focus();
		credit_formula.insertAtCaret(text,0);
		formulaexp(credit_formula.val());
	}
	function formulaexp(result) {
		result = result.replace(/ext_credits_1/g, '<u><?php echo T('ext_credits_1')?></u>');
		result = result.replace(/ext_credits_2/g, '<u><?php echo T('ext_credits_2')?></u>');
		result = result.replace(/ext_credits_3/g, '<u><?php echo T('ext_credits_3')?></u>');
		result = result.replace(/total_followers/g, '<u><?php echo T('total_followers')?></u>');
		result = result.replace(/total_shares/g, '<u><?php echo T('total_shares')?></u>');
		result = result.replace(/total_likes/g, '<u><?php echo T('total_likes')?></u>');
		var formulapermexp = $('#formulapermexp');
		formulapermexp.html(result);
	}
	$(document).ready(function($) {
		var credit_formula = $('#credit_formula');
		formulaexp(credit_formula.val());
		});
</script>
<style type="text/css">
.extcredits a {
	margin-right: 5px;
	padding: 2px 5px;
	line-height: 220%;
	border: 1px solid #B6CFD9;
	background: white;
	white-space: nowrap;
}
u {
text-decoration: underline;
color: #090;
}
</style>
<div class="formbox">
  <form action="<?php echo spUrl('admin','credit_setting',array('act'=>'save'));?>" method="post"  class="form-horizontal settingform">
        <fieldset>
       	 <div class="control-group">
            <label class="control-label" for="site_need_verify"><?php echo T('credit_type')?>:</label>
            <div class="controls">
              <p class="extcredits">
              	<a href="javascript:;" onclick="insertunit('total_followers')"><?php echo T('total_followers')?></a>
              	<a href="javascript:;" onclick="insertunit('total_shares')"><?php echo T('total_shares')?></a>
              	<a href="javascript:;" onclick="insertunit('total_likes')"><?php echo T('total_likes')?></a>
              	<a href="javascript:;" onclick="insertunit('ext_credits_1')"><?php echo T('ext_credits_1')?></a>
              	<a href="javascript:;" onclick="insertunit('ext_credits_2')"><?php echo T('ext_credits_2')?></a>
              	<a href="javascript:;" onclick="insertunit('ext_credits_3')"><?php echo T('ext_credits_3')?></a>
              	<a href="javascript:;" onclick="insertunit(' - ')">&nbsp;-&nbsp;</a>
              	<a href="javascript:;" onclick="insertunit(' + ')">&nbsp;+&nbsp;</a>
              	<a href="javascript:;" onclick="insertunit(' * ')">&nbsp;*&nbsp;</a>
              	<a href="javascript:;" onclick="insertunit(' / ')">&nbsp;/&nbsp;</a>
              	<a href="javascript:;" onclick="insertunit(' (', ') ')">&nbsp;(&nbsp;)&nbsp;</a>
              </p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="credit_formula"><?php echo T('credit_formula')?>:</label>
            <div class="controls">
              <p><u><?php echo T('credits')?></u>=<span id="formulapermexp"></span></p>
              <textarea class="input-xlarge" id="credit_formula" onkeyup="formulaexp(this.value);" name="credit_formula" rows="3"><?php echo $vsettings['credit_formula'];?></textarea>
              <p class="help-block"><?php echo T('tip_credit_formula');?></p>
            </div>
          </div>
         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo T('save')?></button>
          </div>
        </fieldset>
      </form>
</div>
</div>
</div>
</body>
</html>
