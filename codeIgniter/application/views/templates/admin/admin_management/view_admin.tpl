<form name="frmlist" id="frmlist" action="{$data.admin_url}admin_management/action_update" method="post">
    <input type="hidden" name="action" id="action">

<div class="rightside">
    <div class="page-head breadpad">
        <ol class="breadcrumb">
            <li>You are here:</li>
            <li><a href="{$data.admin_url}home">Dashboard</a></li>
            <li class="active">Administrator</li>    
        </ol>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-title">
                        <h3>Admin Management</h3>
                    </div>
                    <div class="box-body">
                        {if $data.message neq ''}
                        <div class="span12">
                            <div class="alert alert-info">
                                {$data.message}
                            </div>
                        </div>
                        {/if}
                        <div class="pull-right">
                            <button type="submit" id="btn-active" class="btn btn-primary btnuser makebtn" onclick="check_all();" >Make Active</button>
                            <button type="submit" id="btn-inactive" class="btn btn-primary btnuser inctivebtn">Make Inactive</button>
                            <button type="button" id="btn-add" onclick="addme('{$data.admin_url}admin_management/create');"  class="btn btn-primary btnuser newadbtn"> Add New</button>
                            <button type="submit" id="btn-delete" class="btn btn-primary btnuser">Delete</button>
                        </div>
                        <div style='clear:both;'></div>
                        <table id="adminlisting" class="table table-bordered table-striped">
                            <thead>
                                <tr class="headings">
                                    <th><center><input type="checkbox" id="check_all" name="check_all" value="1"></center></th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>User Type</th>
                                    <th>Status</th>
                                    <th class=" no-link last"><center>Edit</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                {section name = i loop = $data.adminlist}
                                <tr>
                                <td align="center">
                                    {if $data.adminlist[i].iAdminId neq $data.admindetail.iAdminId}
                                        <input type="checkbox" name="iId[]" id="iId" class="tableflat" value="{$data.adminlist[i].iAdminId}"/>
                                    {/if}
                                </td>
                                    <td>{$data.adminlist[i].vFirstName} {$data.adminlist[i].vLastName}</td>
                                    <td>{$data.adminlist[i].vEmail}</td>
                                    <td>{$data.adminlist[i].eRole}</td>
                                    <td>{$data.adminlist[i].eStatus}</td>
                                    <td align="center"><a href="{$data.admin_url}admin_management/update/{$data.adminlist[i].iAdminId}" style="cursor:pointer;"><i class="fa fa-edit edtcolr"></i></a>
                                </td>
                                </tr>
                                {/section} 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
</form>
{literal}
<script type="text/javascript">
    $('#adminlisting').dataTable( {
        "aoColumns": [
        { "bSortable": false },
        null,
        null,
        null,
        null,
        { "bSortable": false }
        ]
    }); 
</script>
{/literal}