<?php /* Smarty version 2.6.10, created on 2005-09-21 12:20:15
         compiled from manager/emails/emails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'manager/emails/emails.tpl', 18, false),array('modifier', 'escape', 'manager/emails/emails.tpl', 27, false),array('modifier', 'truncate', 'manager/emails/emails.tpl', 27, false),)), $this); ?>

<?php $this->assign('pageTitle', "manager.emails");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/>
<table class="listing" width="100%">
	<tr><td colspan="5" class="headseparator">&nbsp;</td></tr>
	<tr class="heading" valign="bottom">
		<td width="15%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.emailTemplates"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "email.sender"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "email.recipient"), $this);?>
</td>
		<td width="50%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "email.subject"), $this);?>
</td>
		<td width="15%" align="right"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.action"), $this);?>
</td>
	</tr>
	<tr><td colspan="5" class="headseparator">&nbsp;</td></tr>
<?php $_from = $this->_tpl_vars['emailTemplates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['emailTemplates'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['emailTemplates']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['emailTemplate']):
        $this->_foreach['emailTemplates']['iteration']++;
?>
	<tr valign="top">
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...") : smarty_modifier_truncate($_tmp, 20, "...")); ?>
</td>
		<td><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['emailTemplate']->getFromRoleName()), $this);?>
</td>
		<td><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['emailTemplate']->getToRoleName()), $this);?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getSubject())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...") : smarty_modifier_truncate($_tmp, 50, "...")); ?>
</td>
		<td align="right" class="nowrap">
			<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/editEmail/<?php echo ((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a>
			<?php if ($this->_tpl_vars['emailTemplate']->getCanDisable() && ! $this->_tpl_vars['emailTemplate']->isCustomTemplate()): ?>
				<?php if ($this->_tpl_vars['emailTemplate']->getEnabled() == 1): ?>
					<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/disableEmail/<?php echo ((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.disable"), $this);?>
</a>
				<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/enableEmail/<?php echo ((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.enable"), $this);?>
</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['emailTemplate']->isCustomTemplate()): ?>
				<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/deleteCustomEmail/<?php echo ((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.confirmDelete"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/resetEmail/<?php echo ((is_array($_tmp=$this->_tpl_vars['emailTemplate']->getEmailKey())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.confirmReset"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.reset"), $this);?>
</a>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="<?php if (($this->_foreach['emailTemplates']['iteration'] == $this->_foreach['emailTemplates']['total'])): ?>end<?php endif; ?>separator">&nbsp;</td>
	</tr>
<?php endforeach; else: ?>
	<tr>
		<td colspan="5" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.none"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="5" class="endseparator">&nbsp;</td>
	</tr>
<?php endif; unset($_from); ?>
</table>

<br />

<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/createEmail" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.createEmail"), $this);?>
</a><br />
<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/manager/resetAllEmails" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.confirmResetAll"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" class="action" onclick=><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.emails.resetAll"), $this);?>
</a>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>