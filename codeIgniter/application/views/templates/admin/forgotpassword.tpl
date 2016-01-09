<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="{$data.admin_css_path}bootstrap.min.css" />
        <link rel="stylesheet" href="{$data.admin_css_path}font-awesome.min.css" />
        <link rel="stylesheet" href="{$data.admin_css_path}animate/animate.min.css" />
        <link rel="stylesheet" href="{$data.admin_css_path}iCheck/all.css" />
        <link rel="stylesheet" href="{$data.admin_css_path}style.css" />
    
        <title> ::: Happy Hour :::</title>
        
        <!-- Vidalta stylesheets -->

    </head>
    <body class="login fixed">
        <div class="wrapper animated flipInY">
            <div class="logo"><img src='{$data.base_image}logo_happy.png' alt="Happy Hour" class='logorad'></div>
            <div class="box">
                <div class="header clearfix">
                    <div class="pull-left"><i class="fa fa-unlock"></i> Forgot Password</div>
                    <div class="pull-right"><a href="{$data.base_url}admin/authentication"><i class="fa fa-times"></i></a></div>
                </div>
                <form id="forgotform" method="post" action="{$data.base_url}admin/authentication/forgotpassword">
                    {if $data.message neq ''}
                        <div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i> {$data.message}</div>
                    {/if}
                    <div class="box-body padding-md">
                        <div class="form-group">
                            <input type="text" name="vEmail" id="vEmail" class="form-control" placeholder="Email ID"/>
                        </div>
                     <!--    <div class="form-group">                            
                            <select class="form-control" name='eRole' id='eRole'>
                                <option value=''>--- Select your role ---</option>
                                <option value='Admin'>Admin</option>
                                <option value='Brand'>Brand</option>
                                <option value='Super Admin'>Super Admin</option>
                            </select>
                        </div> -->
                        <div class="box-footer">                                                               
                            <button type="submit" class="btn btn-success btn-block frgbtnsub" onclick="validate();">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </body>
</html>