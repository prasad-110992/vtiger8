<?php
/* Smarty version 4.3.2, created on 2024-01-02 09:41:56
  from 'C:\xampp_7_4\htdocs\vtiger8\layouts\v7\modules\Vtiger\Tag.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6593da64f03850_45121415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4ca7c11f8118faf46fee3b668d25f3cfced64a4' => 
    array (
      0 => 'C:\\xampp_7_4\\htdocs\\vtiger8\\layouts\\v7\\modules\\Vtiger\\Tag.tpl',
      1 => 1704184945,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6593da64f03850_45121415 (Smarty_Internal_Template $_smarty_tpl) {
?> 
 <span class="tag <?php if ($_smarty_tpl->tpl_vars['ACTIVE']->value == true) {?> active <?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getType();?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getId();?>
">
    <i class="activeToggleIcon fa <?php if ($_smarty_tpl->tpl_vars['ACTIVE']->value == true) {?> fa-circle-o <?php } else { ?> fa-circle <?php }?>"></i>
    <span class="tagLabel display-inline-block textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
"><?php echo $_smarty_tpl->tpl_vars['TAG_MODEL']->value->getName();?>
</span>
    <?php if (!$_smarty_tpl->tpl_vars['NO_EDIT']->value) {?>
        <i class="editTag fa fa-pencil"></i>
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['NO_DELETE']->value) {?>
        <i class="deleteTag fa fa-times"></i>
    <?php }?>
</span><?php }
}
