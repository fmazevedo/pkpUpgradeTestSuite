<?php /* Smarty version 2.6.9, created on 2005-07-08 06:01:58
         compiled from editor/notifyUsersEmail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'editor/notifyUsersEmail.tpl', 1, false),array('modifier', 'escape', 'editor/notifyUsersEmail.tpl', 43, false),array('modifier', 'nl2br', 'editor/notifyUsersEmail.tpl', 43, false),)), $this); ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "email.multipart"), $this);?>


--<?php echo $this->_tpl_vars['mimeBoundary']; ?>

Content-Type: text/plain; charset=us-ascii
Content-Transfer-Encoding: 7bit

<?php echo $this->_tpl_vars['body']; ?>


<?php echo $this->_tpl_vars['issue']->getIssueIdentification(); ?>

<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "issue.toc"), $this);?>


<?php $_from = $this->_tpl_vars['publishedArticles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sections'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sections']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sectionTitle'] => $this->_tpl_vars['section']):
        $this->_foreach['sections']['iteration']++;
 echo $this->_tpl_vars['sectionTitle']; ?>

--------
<?php $_from = $this->_tpl_vars['section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
 echo $this->_tpl_vars['article']->getArticleTitle();  if ($this->_tpl_vars['article']->getPages()): ?> (<?php echo $this->_tpl_vars['article']->getPages(); ?>
)<?php endif; ?>

<?php $_from = $this->_tpl_vars['article']->getAuthors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['authorList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['authorList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['author']):
        $this->_foreach['authorList']['iteration']++;
?>
	<?php echo $this->_tpl_vars['author']->getFullName();  if (! ($this->_foreach['authorList']['iteration'] == $this->_foreach['authorList']['total'])): ?>,<?php endif;  endforeach; endif; unset($_from); ?>

<?php endforeach; endif; unset($_from); ?>


<?php endforeach; endif; unset($_from);  echo '{$templateSignature}'; ?>


--<?php echo $this->_tpl_vars['mimeBoundary']; ?>

Content-Type: text/html; charset=us-ascii
Content-Transfer-Encoding: 7bit

<html>
	<head>
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
/styles/common.css" type="text/css" />
		<?php $_from = $this->_tpl_vars['stylesheets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cssFile']):
?>
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
/styles/<?php echo $this->_tpl_vars['cssFile']; ?>
" type="text/css" />
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['pageStyleSheet']): ?>
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo $this->_tpl_vars['pageStyleSheet']['uploadName']; ?>
" type="text/css" />
		<?php endif; ?>
		</head>
	<body>

	<p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['body'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>

		<h3><?php echo $this->_tpl_vars['issue']->getIssueIdentification(); ?>
<br /><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "issue.toc"), $this);?>
</h3>
		<?php $_from = $this->_tpl_vars['publishedArticles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sections'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sections']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sectionTitle'] => $this->_tpl_vars['section']):
        $this->_foreach['sections']['iteration']++;
?>
			<h4><?php echo $this->_tpl_vars['sectionTitle']; ?>
</h4>

			<?php $_from = $this->_tpl_vars['section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
				<table width="100%">
					<tr>
						<td><?php echo $this->_tpl_vars['article']->getArticleTitle(); ?>
</td>
						<td align="right">
							<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/article/view/<?php echo $this->_tpl_vars['article']->getBestArticleId($this->_tpl_vars['currentJournal']); ?>
" class="file"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "issue.abstract"), $this);?>
</a>
							<?php if (( ! $this->_tpl_vars['subscriptionRequired'] || $this->_tpl_vars['article']->getAccessStatus() || $this->_tpl_vars['subscribedUser'] )): ?>
								<?php $_from = $this->_tpl_vars['article']->getGalleys(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['galleyList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['galleyList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['galley']):
        $this->_foreach['galleyList']['iteration']++;
?>
									&nbsp;
									<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/article/view/<?php echo $this->_tpl_vars['article']->getBestArticleId($this->_tpl_vars['currentJournal']); ?>
/<?php echo $this->_tpl_vars['galley']->getGalleyId(); ?>
" class="file"><?php echo $this->_tpl_vars['galley']->getLabel(); ?>
</a>
								<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td style="padding-left: 30px;font-style: italic;">
							<?php $_from = $this->_tpl_vars['article']->getAuthors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['authorList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['authorList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['author']):
        $this->_foreach['authorList']['iteration']++;
?>
								<?php echo $this->_tpl_vars['author']->getFullName();  if (! ($this->_foreach['authorList']['iteration'] == $this->_foreach['authorList']['total'])): ?>,<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</td>
						<td align="right"><?php if ($this->_tpl_vars['article']->getPages()):  echo $this->_tpl_vars['article']->getPages();  else: ?>&nbsp;<?php endif; ?></td>
						</tr>
					</table>
				<?php endforeach; endif; unset($_from); ?>
			<?php if (! ($this->_foreach['sections']['iteration'] == $this->_foreach['sections']['total'])): ?>
				<div class="separator"></div>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<pre><?php echo '{$templateSignature}'; ?>
</pre>
	</body>
</html>

--<?php echo $this->_tpl_vars['mimeBoundary']; ?>
--