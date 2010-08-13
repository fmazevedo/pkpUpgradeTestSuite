<?php /* Smarty version 2.6.9, created on 2005-07-08 06:02:05
         compiled from submission/comment/peerReviewComment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ord', 'submission/comment/peerReviewComment.tpl', 21, false),array('modifier', 'chr', 'submission/comment/peerReviewComment.tpl', 23, false),array('modifier', 'date_format', 'submission/comment/peerReviewComment.tpl', 28, false),array('modifier', 'escape', 'submission/comment/peerReviewComment.tpl', 40, false),array('modifier', 'nl2br', 'submission/comment/peerReviewComment.tpl', 46, false),array('function', 'translate', 'submission/comment/peerReviewComment.tpl', 23, false),array('function', 'fieldLabel', 'submission/comment/peerReviewComment.tpl', 73, false),)), $this); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "submission/comment/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="data" width="100%">
<?php $_from = $this->_tpl_vars['articleComments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
<tr valign="top">
	<td width="25%">
		<div class="commentRole">
			<?php if ($this->_tpl_vars['showReviewLetters'] && $this->_tpl_vars['comment']->getRoleId() == $this->_tpl_vars['reviewer']): ?>
				<?php $this->assign('start', ((is_array($_tmp='A')) ? $this->_run_mod_handler('ord', true, $_tmp) : ord($_tmp))); ?>
				<?php $this->assign('reviewId', $this->_tpl_vars['comment']->getAssocId()); ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['comment']->getRoleName()), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['reviewLetters'][$this->_tpl_vars['reviewId']]+$this->_tpl_vars['start'])) ? $this->_run_mod_handler('chr', true, $_tmp) : chr($_tmp)); ?>

			<?php else: ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['comment']->getRoleName()), $this);?>

			<?php endif; ?>
		</div>
		<div class="commentDate"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->getDatePosted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
</div>
		<br />
		<div class="commentNote">
			<?php if ($this->_tpl_vars['comment']->getViewable()): ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.canShareWithAuthor"), $this);?>

			<?php else: ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.cannotShareWithAuthor"), $this);?>

			<?php endif; ?>
		</div>
	</td>
	<td width="75%">
		<?php if ($this->_tpl_vars['comment']->getAuthorId() == $this->_tpl_vars['userId'] && ! $this->_tpl_vars['isLocked']): ?>
			<div style="float: right"><a href="<?php echo $this->_tpl_vars['requestPageUrl']; ?>
/editComment/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['comment']->getCommentId(); ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a> <a href="<?php echo $this->_tpl_vars['requestPageUrl']; ?>
/deleteComment/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['comment']->getCommentId(); ?>
" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.confirmDelete"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a></div>
		<?php endif; ?>
		<a name="<?php echo $this->_tpl_vars['comment']->getCommentId(); ?>
"></a>
		<?php if ($this->_tpl_vars['comment']->getCommentTitle()): ?>
			<div class="commentTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.subject"), $this);?>
: <?php echo $this->_tpl_vars['comment']->getCommentTitle(); ?>
</div>
		<?php endif; ?>
		<div class="comments"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->getComments())) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
	</td>
</tr>
<?php endforeach; else: ?>
<tr>
	<td class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.noReviews"), $this);?>
</td>
</tr>
<?php endif; unset($_from); ?>
</table>

<br />
<br />

<?php if (! $this->_tpl_vars['isLocked']): ?>
<form method="post" action="<?php echo $this->_tpl_vars['requestPageUrl']; ?>
/<?php echo $this->_tpl_vars['commentAction']; ?>
">
<?php if ($this->_tpl_vars['hiddenFormParams']): ?>
	<?php $_from = $this->_tpl_vars['hiddenFormParams']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['hiddenFormParam']):
?>
		<input type="hidden" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['hiddenFormParam']; ?>
" />
	<?php endforeach; endif; unset($_from);  endif; ?>


<a name="new"></a>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/formErrors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="data" width="100%">
<tr valign="top">
	<td class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'commentTitle','key' => "submission.comments.subject"), $this);?>
</td>
	<td class="value"><input type="text" name="commentTitle" id="commentTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['commentTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="50" maxlength="100" class="textField" /></td>
</tr>
<tr valign="top">
	<td class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'authorComments'), $this); echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.forAuthorEditor"), $this);?>
</td>
	<td class="value"><textarea id="authorComments" name="authorComments" rows="10" cols="50" class="textArea"><?php echo $this->_tpl_vars['authorComments']; ?>
</textarea></td>
</tr>
<tr valign="top">
	<td class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'comments'), $this); echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.comments.forEditor"), $this);?>
</td>
	<td class="value"><textarea id="comments" name="comments" rows="10" cols="50" class="textArea"><?php echo $this->_tpl_vars['comments']; ?>
</textarea></td>
</tr>
</table>

<p><input type="submit" name="save" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.save"), $this);?>
" class="button defaultButton" /> <?php if ($this->_tpl_vars['canEmail']): ?><input type="submit" name="saveAndEmail" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndEmail"), $this);?>
" class="button" /><?php endif; ?> <input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.done"), $this);?>
" class="button" onclick="window.opener.location.reload(); window.close()" /></p>

<p><span class="formRequired"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.requiredField"), $this);?>
</span></p>

</form>

<?php else: ?>
<input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.close"), $this);?>
" class="button defaultButton" style="width: 5em" onclick="window.close()" />
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "submission/comment/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>