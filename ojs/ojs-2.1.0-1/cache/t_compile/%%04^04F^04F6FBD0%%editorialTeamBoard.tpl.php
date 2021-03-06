<?php /* Smarty version 2.6.12, created on 2006-02-03 13:26:32
         compiled from about/editorialTeamBoard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'about/editorialTeamBoard.tpl', 22, false),array('modifier', 'escape', 'about/editorialTeamBoard.tpl', 22, false),)), $this); ?>

<?php $this->assign('pageTitle', "about.editorialTeam");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
<h4><?php echo $this->_tpl_vars['group']->getGroupTitle(); ?>
</h4>
<?php $this->assign('groupId', $this->_tpl_vars['group']->getGroupId());  $this->assign('members', $this->_tpl_vars['teamInfo'][$this->_tpl_vars['groupId']]); ?>

<?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
	<?php $this->assign('user', $this->_tpl_vars['member']->getUser()); ?>
	<a href="javascript:openRTWindow('<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'editorialTeamBio','path' => $this->_tpl_vars['user']->getUserId()), $this);?>
')"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getFullName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a><?php if ($this->_tpl_vars['user']->getAffiliation()): ?>, <?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getAffiliation())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  endif;  if ($this->_tpl_vars['user']->getCountry()):  $this->assign('countryCode', $this->_tpl_vars['user']->getCountry());  $this->assign('country', $this->_tpl_vars['countries'][$this->_tpl_vars['countryCode']]); ?>, <?php echo $this->_tpl_vars['country'];  endif; ?>
	<br />
<?php endforeach; endif; unset($_from);  endforeach; endif; unset($_from); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>