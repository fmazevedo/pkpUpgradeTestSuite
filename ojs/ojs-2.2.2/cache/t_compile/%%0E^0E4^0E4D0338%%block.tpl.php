<?php /* Smarty version 2.6.18, created on 2010-08-12 15:58:44
         compiled from file:/Applications/MAMP/htdocs/dev/pkpUpgradeTests/ojs/ojs-2.2.2/plugins/blocks/navigation//block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'file:/Applications/MAMP/htdocs/dev/pkpUpgradeTests/ojs/ojs-2.2.2/plugins/blocks/navigation//block.tpl', 12, false),array('function', 'url', 'file:/Applications/MAMP/htdocs/dev/pkpUpgradeTests/ojs/ojs-2.2.2/plugins/blocks/navigation//block.tpl', 15, false),array('function', 'html_options_translate', 'file:/Applications/MAMP/htdocs/dev/pkpUpgradeTests/ojs/ojs-2.2.2/plugins/blocks/navigation//block.tpl', 22, false),)), $this); ?>
<div class="block" id="sidebarNavigation">
	<span class="blockTitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "plugins.block.navigation.journalContent"), $this);?>
</span>
	
	<span class="blockSubtitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.search"), $this);?>
</span>
	<form method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'results'), $this);?>
">
	<table>
	<tr>
		<td><input type="text" id="query" name="query" size="15" maxlength="255" value="" class="textField" /></td>
	</tr>
	<tr>
		<td><select name="searchField" size="1" class="selectMenu">
			<?php echo $this->_plugins['function']['html_options_translate'][0][0]->smartyHtmlOptionsTranslate(array('options' => $this->_tpl_vars['articleSearchByOptions']), $this);?>

		</select></td>
	</tr>
	<tr>
		<td><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.search"), $this);?>
" class="button" /></td>
	</tr>
	</table>
	</form>
	
	<br />
	
	<?php if ($this->_tpl_vars['currentJournal']): ?>
	<span class="blockSubtitle"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browse"), $this);?>
</span>
	<ul>
		<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'issue','op' => 'archive'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByIssue"), $this);?>
</a></li>
		<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'authors'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByAuthor"), $this);?>
</a></li>
		<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'search','op' => 'titles'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.browseByTitle"), $this);?>
</a></li>
		<?php if ($this->_tpl_vars['hasOtherJournals']): ?>
		<li><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('journal' => 'index'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.otherJournals"), $this);?>
</a></li>
		<?php endif; ?>
	</ul>
	<?php endif; ?>
</div>