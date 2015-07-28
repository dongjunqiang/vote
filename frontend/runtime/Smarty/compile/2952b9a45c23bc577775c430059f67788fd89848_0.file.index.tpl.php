<?php /* Smarty version 3.1.27, created on 2015-07-23 14:07:28
         compiled from "D:\wamp\www\yii2\frontend\views\vote\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1931755b084a063b0e4_07704087%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2952b9a45c23bc577775c430059f67788fd89848' => 
    array (
      0 => 'D:\\wamp\\www\\yii2\\frontend\\views\\vote\\index.tpl',
      1 => 1427693586,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1931755b084a063b0e4_07704087',
  'variables' => 
  array (
    'data' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55b084a06bfe06_58596902',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b084a06bfe06_58596902')) {
function content_55b084a06bfe06_58596902 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1931755b084a063b0e4_07704087';
?>
<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>投票活动</title>
</head>
<body>
	<table class="table">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>时间</th>
        </tr>
        <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['r'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['r']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->_loop = true;
$foreach_r_Sav = $_smarty_tpl->tpl_vars['r'];
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
</td>
            <td><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->functionUrl(array('route'=>"vote/list/".((string)$_smarty_tpl->tpl_vars['r']->value['id'])),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['r']->value['add_time'];?>
</td>
        </tr>
        <?php
$_smarty_tpl->tpl_vars['r'] = $foreach_r_Sav;
}
?>
    </table>
</body>
</html><?php }
}
?>