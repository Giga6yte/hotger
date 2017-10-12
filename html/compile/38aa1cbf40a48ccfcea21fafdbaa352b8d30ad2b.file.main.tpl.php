<?php /* Smarty version Smarty-3.1.19-dev, created on 2017-10-12 23:06:31
         compiled from "html\templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:766659dfcb47c68d57-32068498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38aa1cbf40a48ccfcea21fafdbaa352b8d30ad2b' => 
    array (
      0 => 'html\\templates\\main.tpl',
      1 => 1507808314,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '766659dfcb47c68d57-32068498',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'author' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_59dfcb47ca36f1_62820196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dfcb47ca36f1_62820196')) {function content_59dfcb47ca36f1_62820196($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['author']->value;?>
">

        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

        <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="col-sm-6">
                <h1 class="header">  </h1>
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <a class="btn btn-default" href="?tmpt=gen" role="button">Генератор чисел</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <a class="btn btn-default" href="?tmpt=phonebook" role="button">Телефонный справочник</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html><?php }} ?>
