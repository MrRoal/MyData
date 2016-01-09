<?php /* Smarty version Smarty-3.1.11, created on 2016-01-09 11:54:50
         compiled from "application/views/templates/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2446509315690929a74bed5-06691878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '818fe1451fa639e8561141c63be5d17b8f7b1bb4' => 
    array (
      0 => 'application/views/templates/admin/login.tpl',
      1 => 1452315283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2446509315690929a74bed5-06691878',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5690929a75f7d4_25463405',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5690929a75f7d4_25463405')) {function content_5690929a75f7d4_25463405($_smarty_tpl) {?><!DOCTYPE html>
<html class="no-js">
    <head>
        <title> ::: <?php echo $_smarty_tpl->tpl_vars['data']->value['SITE_NAME'];?>
 ::: </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['admin_base_url'];?>
assets/admin/image/favicon.ico">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="#" />
    </head>
    <body class="login fixed">
    Welcome to Admin
    <script src="#" type="text/javascript"></script>
    </body>
</html><?php }} ?>