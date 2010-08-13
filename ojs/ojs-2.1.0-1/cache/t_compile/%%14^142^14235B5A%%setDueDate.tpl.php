<?php /* Smarty version 2.6.12, created on 2006-02-03 13:26:43
         compiled from sectionEditor/setDueDate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'sectionEditor/setDueDate.tpl', 15, false),array('function', 'url', 'sectionEditor/setDueDate.tpl', 19, false),array('modifier', 'to_array', 'sectionEditor/setDueDate.tpl', 19, false),array('modifier', 'escape', 'sectionEditor/setDueDate.tpl', 23, false),array('modifier', 'date_format', 'sectionEditor/setDueDate.tpl', 28, false),)), $this); ?>

<?php $this->assign('pageTitle', "submission.dueDate");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.designateDueDate"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.designateDueDateDescription"), $this);?>
</p>

<form method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => $this->_tpl_vars['actionHandler'],'path' => ((is_array($_tmp=$this->_tpl_vars['articleId'])) ? $this->_run_mod_handler('to_array', true, $_tmp, $this->_tpl_vars['reviewId']) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp, $this->_tpl_vars['reviewId']))), $this);?>
">
	<table class="data" width="100%">
		<tr valign="top">
			<td class="label" width="20%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.todaysDate"), $this);?>
</td>
			<td class="value" width="80%"><?php echo ((is_array($_tmp=$this->_tpl_vars['todaysDate'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
		</tr>
		<tr valign="top">
			<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.requestedByDate"), $this);?>
</td>
			<td class="value">
				<input type="text" size="11" maxlength="10" name="dueDate" value="<?php if ($this->_tpl_vars['dueDate']):  echo ((is_array($_tmp=$this->_tpl_vars['dueDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d"));  endif; ?>" class="textField" onfocus="this.form.numWeeks.value=''" />
				<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.dueDateFormat"), $this);?>
</span>
			</td>
		</tr>
		<tr valign="top">
			<td>&nbsp;</td>
			<td class="value"><span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.or"), $this);?>
</span></td>
		</tr>
		<tr valign="top">
			<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "editor.article.numberOfWeeks"), $this);?>
</td>
			<td class="value"><input type="text" name="numWeeks" value="<?php if (! $this->_tpl_vars['dueDate']):  echo $this->_tpl_vars['numWeeksPerReview'];  endif; ?>" size="3" maxlength="2" class="textField" onfocus="this.form.dueDate.value=''" /></td>
		</tr>
	</table>
<p><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.continue"), $this);?>
" class="button defaultButton" /> <input type="button" class="button" onclick="history.go(-1)" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
"></p>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>