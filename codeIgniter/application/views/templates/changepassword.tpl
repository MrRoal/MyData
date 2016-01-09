{include file='header.tpl'}
<div class="row-fluid">
    <div class="navbar">
        <div class="navbar-inner">
            {$data.breadcrumb}
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left contactus">Change Password</div>
            </div>
            <div class="block-content collapse leftdivnew">
			    <form class="form-horizontal" id="changepwd" action="{$data.base_url}home/reset_password" method="post">
				    
				    <input type="hidden" name="iUserId" id="iUserId" value="{$iUserId}">
				    <div class="control-group">
					    <label class="control-label rightheadingnew" for="typeahead">New Password<sup><span style="color:#CC2131">*</span></sup></label>
					    <div class="controls">
						    <input type="password" class="span3 txtfield" placeholder="New Password" id="vPassword" name="vPassword">
						    <span id="valpassword" style="display:none;" class="validationfrm loginmsg">Please Enter Password.</span>
					    </div>
				    </div>

				    <div class="control-group">
					    <label class="control-label rightheadingnew" for="typeahead">Confirm Password<sup><span style="color:#CC2131">*</span></sup></label>
					    <div class="controls">
						    <input type="password" class="span3 txtfield" placeholder="Confirm Password" id="confirmpwd" name="confirmpwd">
						    <span id="valconfirmpwd" style="display:none;" class="validationfrm loginmsg">Please Enter Confirm Password.</span>
					    </div>
				    </div>

				    <div class="form-actions">
					    <button type="submit" id="btn-save" class="btn bottom-buffer sendform" >Save Change</button>
					    <!-- <button type="button" class="btn bottom-buffer sendform" onclick="returnme();">Cancel</button> -->
					    
				    </div>
		        </form>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}

{literal}
<script type="text/javascript">

	$(document).ready(function(){
		$('#btn-save').click(function(){
			var valid = 0;
			if($("#vPassword" ).val() ==''){
	            $("#vPassword" ).attr('class','txtfield inplogin loginwrap_error_text');
	            $("#valpassword").show();
	            valid=1;
	        }else{
	            $("#vPassword" ).attr('class','inplogin txtfield');
	            $("#valpassword").hide();
	        }
	        var pass = $("#vPassword" ).val();
	        var confirmpass = $("#confirmpwd" ).val();

	        if($("#confirmpwd" ).val() ==''){
	            $("#confirmpwd" ).attr('class','txtfield inplogin loginwrap_error_text');
	            $("#valconfirmpwd").show();
	            valid=1;
	        }
	        else if(confirmpass != pass){
	            $("#confirmpwd" ).attr('class','txtfield inplogin loginwrap_error_text');
	            $("#valconfirmpwd").show();
	            $("#valconfirmpwd").text("Password and Confirm Password must be Same");
	            valid=1;
	        }else{
	            $("#confirmpwd" ).attr('class','inplogin txtfield');
	            $("#valconfirmpwd").hide();
	        }

	        if(valid == 0){
	           return true;
	        }else{
	            return false;
	        }
    	});
	});

</script>
{/literal}