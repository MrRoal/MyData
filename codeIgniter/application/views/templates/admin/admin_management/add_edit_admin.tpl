<style type="text/css">
	.numbermobi{
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	    border: 0 none;
	    float: right;
	    margin: 8px 49px 0;
	    width: 83%;
	    padding: none;

	}
	.mobi_country{
		background: #ffffff none repeat scroll 0 0;
	    border: 1px solid #D8DDE5;
	    float: left;
	    height: 35px;
	    padding: 0 2%;
	    width: 100%;
	}
	.codenumber{
		float: left;
	    padding: 12px 0 0;
	    text-align: left;
	    width: 5%;
	    border-right: 1px solid #D8DDE5;
	}
</style>

<div class="rightside">
    <div class="page-head breadpad">
        <ol class="breadcrumb">
            <li>You are here:</li>
            <li><a href="{$data.admin_url}home">Dashboard</a></li>
            <li><a href="{$data.admin_url}admin_management">View Admin</a></li>
            <li class="active">{if $data.action eq 'update'}Update{else}Add{/if} Admin</li>
        </ol>
    </div>

    {if $data.message neq ''}
    <div class="span12">
        <div class="alert alert-info">
            {$data.message}
        </div>
    </div>
    {/if}

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-title">
                        <h3>Admin Management</h3>
                    </div>
                    <div class="box-body">
						<form role="form" id="frmadmin" action="{$data.admin_url}admin_management/{$data.action}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="iAdminId" value='{$data.admin_detail.iAdminId}'>
							<input type="hidden" id="db_admin_email" value='{$data.admin_detail.vEmail}'>

							<div class="form-group">
								<label>First Name<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vFirstName" name="vFirstName" value="{$data.admin_detail.vFirstName}">
							</div>

							<div class="form-group">
								<label>Last Name<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vLastName" name="vLastName" value="{$data.admin_detail.vLastName}">
							</div>

							<div class="form-group">
								<label>Email ID<sup><span style="color:#CC2131">*</span></sup></label>
								<input type="text" class="form-control" id="vEmail" name="vEmail" value="{$data.admin_detail.vEmail}">
							</div>

							<div class="form-group">
								<label>Mobile No<sup><span style="color:#CC2131">*</span></sup> </label>
								<div class="mobi_country">
								<p class="codenumber" id="mobilecode">+65</p>
								<input type="text" class="numbermobi" id="iMobileNo" name="iMobileNo" value="{$data.admin_detail.iMobileNo}" onkeypress="return checkprise(event);" maxlength="8">
								</div>
							</div>

							<div class="form-group">
								<label>Role<sup><span style="color:#CC2131">*</span></sup></label>
								<select class="form-control" name="eRole" id="eRole" >
									<option value="">-- Select Role --</option>
									{section name=i loop=$eRole}
									<option {if $eRole[i] eq $data.admin_detail['eRole']}selected="selected"{/if}value="{$eRole[i]}">{$eRole[i]}</option>
									{/section}
								</select>
							</div>

							{if $data.action eq 'create'}
								<div class="form-group">
									<label>Password<sup><span style="color:#CC2131">*</span></sup></label>
									<input type="password" class="form-control" id="vPassword" name="vPassword" value="{$data.admin_detail.vPassword}">
								</div>
							{else}
								<div class="form-group">
									<label>Status<sup><span style="color:#CC2131">*</span></sup></label>
									<select class="form-control" name="eStatus" id="eStatus" >
										<option value="">-- Select Status --</option>
										{section name=i loop=$eStatuses}
										<option {if $eStatuses[i] eq $data.admin_detail['eStatus']}selected="selected"{/if}value="{$eStatuses[i]}">{$eStatuses[i]}</option>
										{/section}
									</select>
								</div>
							{/if}
						
							{if $data.action eq 'create'}
								<button type="submit" id="btn-save" class="btn btn-primary">Save</button>
							{else}
								<button type="submit" id="btn-save" class="btn btn-primary">Save Change</button>
							{/if}
							<button type="button" class="btn btn-primary" onclick="returnme();">Cancel</button>
							<span  id="loader" style="float: left;padding-right:15px;display: block;"></span>
						</form>
					</div>
				</div>

				{if $data.admin_detail.eRole eq 'Subadmin'}
					<div class="box">
				    	<div class="box-title">
				        	<h3>Access Permission</h3>
				    	</div>
					    <div class="box-body">
							<form role="form" id="addAdminAccessForm" action='{$data.admin_url}admin_management/edit' method='post' enctype="multipart/form-data">
								<table class="table table-bordered table-striped table-condensed">
	                                <thead>
	                                <tr>
	                                    <th>Module Name</th>
	                                    <th> <input type="checkbox" id="Listingcheck_all" name="Listingcheck_all" value="1"> Listing</th>
	                                    <th> <input type="checkbox" id="Addcheck_all" name="Addcheck_all" value="1"> Add</th>
	                                    <th> <input type="checkbox" id="Updatecheck_all" name="Updatecheck_all" value="1"> Update</th>
	                                    <th> <input type="checkbox" id="Deletecheck_all" name="Deletecheck_all" value="1"> Delete</th>
	                                    <th> <input type="checkbox" id="Activecheck_all" name="Activecheck_all" value="1"> Active</th>
	                                    <th> <input type="checkbox" id="Inactivecheck_all" name="Inactivecheck_all" value="1"> Inactive</th>
	                                    <th> <input type="checkbox" id="ImportSongs_all" name="ImportSongs_all" value="1"> Export Merchant</th>
	                                    <th> <input type="checkbox" id="ExportUsers_all" name="ExportUsers_all" value="1"> Export Users</th>
	                                    <th> <input type="checkbox" id="SendPushnotification_all" name="SendPushnotification_all" value="1"> Send Pushnotification</th>
	                                </tr>
	                                </thead>
	                                <tbody>
	                                {section name=i loop=$data.moduleArr}
	                                    <tr>
	                                        <td>{$data.moduleArr[i].vModuleName}</td>
	                                        <td>
	                                            <input class="ListingiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="ListingiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tListing}checked{/if} value="{$data.moduleArr[i].iModuleId}" />
	                                        </td>
	                                        <td>
	                                            <input class="AddiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="AddiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tAdd}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        <td>
	                                            <input class="UpdateiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="UpdateiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tUpdate}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        <td>
	                                            <input class="DeleteiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="DeleteiId[]"  {if $data.moduleArr[i].iModuleId|in_array:$Arr.tDelete}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        <td>
	                                            <input class="ActiveiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="ActiveiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tActive}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        <td>
	                                            <input class="InactiveiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="InactiveiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tInactive}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        {if $data.moduleArr[i].iModuleId eq '5'}
	                                        <td>
	                                            <input class="ExportMerchantiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="ExportMerchantiId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tExportMerchant}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        {else}
	                                        <td></td>
	                                        {/if}
	                                        {if $data.moduleArr[i].iModuleId eq '6'}
	                                        <td>
	                                            <input class="ExportUsersiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="ExportUsersId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tExportUsers}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        {else}
	                                        <td></td>
	                                        {/if}
	                       					{if $data.moduleArr[i].iModuleId eq '13'}
	                                        <td>
	                                            <input class="SendPushnotificationiId" type="checkbox" style="width: 20px" class="checkbox form-control" name="SendPushnotificationId[]" {if $data.moduleArr[i].iModuleId|in_array:$Arr.tSendPushnotification}checked{/if} value="{$data.moduleArr[i].iModuleId}">
	                                        </td>
	                                        {else}
	                                        <td></td>
	                                        {/if}
	                                    </tr>
	                                {/section}
	                                </tbody>
	                            </table>
								<input type='hidden' name='iAdminId' id='iAdminId' value='{$data.iAdminId}'>
									
								  <button type="submit" class="btn btn-primary">Submit</button>
							</form>
					    </div>
					</div>
				{/if}
			</div>
		</div>
	</div>
{literal}
<script type="text/javascript">
var iAdminId = "{/literal}{$data.iAdminId}{literal}";
	$(document).ready(function() {
	    $("#Listingcheck_all").change(function(){ $(':checkbox.ListingiId').prop('checked', this.checked); });
	    $("#Addcheck_all").change(function(){ $(':checkbox.AddiId').prop('checked', this.checked); });
	    $("#Updatecheck_all").change(function(){ $(':checkbox.UpdateiId').prop('checked', this.checked); });
	    $("#Deletecheck_all").change(function(){ $(':checkbox.DeleteiId').prop('checked', this.checked); });
	    $("#Activecheck_all").change(function(){ $(':checkbox.ActiveiId').prop('checked', this.checked); });
	    $("#Inactivecheck_all").change(function(){ $(':checkbox.InactiveiId').prop('checked', this.checked); });
	    $("#ImportSongs_all").change(function(){ $(':checkbox.ExportMerchantiId').prop('checked', this.checked); });
	    $("#ExportUsers_all").change(function(){ $(':checkbox.ExportUsersiId').prop('checked', this.checked); });
	    $("#SendPushnotification_all").change(function(){ $(':checkbox.SendPushnotificationiId').prop('checked', this.checked); });
	});

	function returnme()
	{
	    window.location.href = base_url+'admin_management';
	}

	$(document).ready(function() {
	    $('#frmadmin').bootstrapValidator({
	        message: 'This value is not valid',
	        icon: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
	        fields: {
	            vFirstName: {
	                validators: {
	                    notEmpty: { message: 'First Name is required and can\'t be empty' },
	                     
	                }
	            },
	            vLastName: {
	                validators: {
	                    notEmpty: { message: 'Last Name is required and can\'t be empty' },
	                     
	                }
	            },
	            vEmail: {
	                validators: {
	                    notEmpty: {
	                        message: 'Email address is required and can\'t be empty'
	                    },
	                    emailAddress: {
	                        message: 'The input is not a valid email address'
	                    },
	                    remote: {
	                        url: '{/literal}{$data.admin_url}{literal}admin_management/checkEmailExist/'+iAdminId,
	                        data: function(validator) {
	                            return {
	                                vEmail: validator.getFieldElements('vEmail').val()
	                            };
	                        },
	                        message: 'Email is Already Exist'
	                    } 
	                }
	            },
	            vPassword: {
	                validators: {
	                    notEmpty: {
	                        message: 'Password is required and can\'t be empty'
	                    },
	                     
	                }  
	            },
	            iMobileNo: {
	                validators: {
	                    notEmpty: {
	                        message: 'Mobile Number is required and can\'t be empty'
	                    },
	                     
	                }  
	            },
	            eRole: {
	                validators: {
	                    notEmpty: {
	                        message: 'Role Type is required and can\'t be empty'
	                    },
	                     
	                }  
	            },
	            eStatus: {
	                validators: {
	                    notEmpty: {
	                        message: 'Status is required and can\'t be empty'
	                    }
	                }
	            }
	        }
	    });
	});

</script>
{/literal}