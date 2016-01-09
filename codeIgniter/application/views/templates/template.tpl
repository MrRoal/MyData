<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <title> ::: Demo ::: </title>
    <link rel="shortcut icon" type="image/x-icon" href="{$data.base_url}assets/frontend/images/favicon.ico">
    
    <link rel="stylesheet" type="text/css" href="{$data.front_css}style.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="{$data.front_slick}slick.css"/>
    <link rel="stylesheet" type="text/css" href="{$data.front_slick}slick-theme.css"/>

    <script>
        var base_url = '{$data.base_url}';
        var front_image = '{$data.front_image}';
        var iMemberId = '{$data.userdata.front_user.iMemberId}';
        var FB_APPID = '{$data.FB_APPID}';
        var base_upload = '{$data.base_upload}';
    </script>

   
</head>
<body>
    <div class="wrapper">
        {include file=$data.tpl_name}
    </div>
    

<script type="text/javascript" src="{$data.front_js}jquery.uniform.min.js"></script>
<script type="text/javascript" src="{$data.front_js}jquery.datetimepicker.js"></script>
<script type="text/javascript" src="{$data.front_js}jquery.slicknav.min.js"></script>
<script type="text/javascript" src="{$data.front_js}infobox.js"></script>
<script type="text/javascript" src="{$data.front_js}wow.min.js"></script>
<script type="text/javascript" src="{$data.front_js}search.js"></script>
<script type="text/javascript" src="{$data.front_js}scripts.js"></script>

</body>
</html>