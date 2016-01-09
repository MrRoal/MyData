<!DOCTYPE html>
<html>
<head>
    <title> ::: Demo ::: </title>
    <!-- Bootstrap -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <link rel="shortcut icon" type="image/x-icon" href="{$data.admin_base_url}assets/admin/image/favicon.ico">
    

    <link rel="stylesheet" href="{$data.admin_css_path}bootstrap.min.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}font-awesome.min.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}gritter/jquery.gritter.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}jquery-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}animate/animate.min.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}iCheck/all.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}style.css" />

    <link rel="stylesheet" href="{$data.admin_css_path}bootstrapValidator/bootstrapValidator.min.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{$data.admin_css_path}datatables/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="{$data.admin_css_path}bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"  />
    <link href="{$data.admin_css_path}magnific-popup.min.css" rel="stylesheet">

    <script src="{$data.admin_js_path}plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/jquery-ui/jquery-ui-1.10.4.min.js" type="text/javascript"></script>
    
    <link href="{$data.admin_css_path}dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <script src="{$data.admin_js_path}plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>    
    <link rel="stylesheet" href="{$data.admin_css_path}datepicker/datepicker.css" />
    <script src="{$data.admin_js_path}plugins/datepicker/datepicker.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}fileinput.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}common.js"></script>
    <script type="text/javascript">
        var base_image = '{$data.admin_image_path}';
        var base_url = '{$data.admin_url}';
    </script>       
</head>

<body class="fixed">
    {include file="admin/header.tpl" }

    <div class="wrapper">
        {include file="admin/left_sidemenu.tpl" }

        {include file=$data.tpl_name}
    </div>

    <!-- Bootstrap -->
    <script src="{$data.admin_js_path}plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/gritter/jquery.gritter.min.js" type="text/javascript"></script>
    
    
    <!-- Interface -->
    <script src="{$data.admin_js_path}plugins/jquery-countTo/jquery.countTo.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/nicescroll/jquery.nicescroll.js"></script>
    <script src="{$data.admin_js_path}plugins/pace/pace.min.js" type="text/javascript"></script>
    
    <!-- Forms -->
    <script src="{$data.admin_js_path}plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}custom.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}plugins/bootstrapValidator/bootstrapValidator.min.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}commonvalidation.js" type="text/javascript"></script>
    <script src="{$data.admin_js_path}jquery.magnific-popup.min.js"></script>   
    <script src="{$data.admin_js_path}magnify-pop-app.js"></script>
    <!-- Modal -->
    <div class="modal fade" id="ModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Error</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-defaultmodal modalcancelbtn" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>