<?php

/**
 * @file classes/article/log/ArticleEventLogDAO.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ArticleEventLogDAO
 * @ingroup article_log
 * @see ArticleEventLogEntry
 *
 * @brief Class for inserting/accessing article history log entries.
 */

// $Id: ArticleEventLogDAO.inc.php,v 1.21.2.1 2009/04/08 19:42:46 asmecher Exp $


import ('article.log.ArticleEventLogEntry');

class ArticleEventLogDAO extends DAO {
	/**
	 * Retrieve a log entry by ID.
	 * @param $logId int
	 * @param $articleId int optional
	 * @return ArticleEventLogEntry
	 */
	function &getLogEntry($logId, $articleId = null) {
		if (isset($articleId)) {
			$result = &$this->retrieve(
				'SELECT * FROM article_event_log WHERE log_id = ? AND article_id = ?',
				array($logId, $articleId)
			);
		} else {
			$result = &$this->retrieve(
				'SELECT * FROM article_event_log WHERE log_id = ?', $logId
			);
		}

		$returner = null;
		if ($result->RecordCount() != 0) {
			$returner = &$this->_returnLogEntryFromRow($result->GetRowAssoc(false));
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Retrieve all log entries for an article.
	 * @param $articleId int
	 * @return DAOResultFactory containing matching ArticleEventLogEntry ArticleEventLogEntry ordered by sequence
	 */
	function &getArticleLogEntries($articleId, $rangeInfo = null) {
		$returner = &$this->getArticleLogEntriesByAssoc($articleId, null, null, $rangeInfo);
		return $returner;
	}

	/**
	 * Retrieve all log entries for an article matching the specified association.
	 * @param $articleId int
	 * @param $assocType int
	 * @param $assocId int
	 * @param $limit int limit the number of entries retrieved (default false)
	 * @param $recentFirst boolean order with most recent entries first (default true)
	 * @return DAOResultFactory containing matching ArticleEventLogEntry ordered by sequence
	 */
	function &getArticleLogEntriesByAssoc($articleId, $assocType = null, $assocId = null, $rangeInfo = null) {
		$params = array($articleId);
		if (isset($assocType)) {
			array_push($params, $assocType);
			if (isset($assocId)) {
				array_push($params, $assocId);
			}
		}

		$result = &$this->retrieveRange(
			'SELECT * FROM article_event_log WHERE article_id = ?' . (isset($assocType) ? ' AND assoc_type = ?' . (isset($assocId) ? ' AND assoc_id = ?' : '') : '') . ' ORDER BY log_id DESC',
			$params, $rangeInfo
		);

		$returner = &new DAOResultFactory($result, $this, '_returnLogEntryFromRow');
		return $returner;
	}

	/**
	 * Internal function to return an ArticleEventLogEntry object from a row.
	 * @param $row array
	 * @return ArticleEventLogEntry
	 */
	function &_returnLogEntryFromRow(&$row) {
		$entry = &new ArticleEventLogEntry();
		$entry->setLogId($row['log_id']);
		$entry->setArticleId($row['article_id']);
		$entry->setUserId($row['user_id']);
		$entry->setDateLogged($this->datetimeFromDB($row['date_logged']));
		$entry->setIPAddress($row['ip_address']);
		$entry->setLogLevel($row['log_level']);
		$entry->setEventType($row['event_type']);
		$entry->setAssocType($row['assoc_type']);
		$entry->setAssocId($row['assoc_id']);
		$entry->setMessage($row['message']);

		HookRegistry::call('ArticleEventLogDAO::_returnLogEntryFromRow', array(&$entry, &$row));

		return $entry;
	}

	/**
	 * Insert a new log entry.
	 * @param $entry ArticleEventLogEntry
	 */	
	function insertLogEntry(&$entry) {
		if ($entry->getDateLogged() == null) {
			$entry->setDateLogged(Core::getCurrentDate());
		}
		if ($entry->getIPAddress() == null) {
			$entry->setIPAddress(Request::getRemoteAddr());
		}
		$this->update(
			sprintf('INSERT INTO article_event_log
				(article_id, user_id, date_logged, ip_address, log_level, event_type, assoc_type, assoc_id, message)
				VALUES
				(?, ?, %s, ?, ?, ?, ?, ?, ?)',
				$this->datetimeToDB($entry->getDateLogged())),
			array(
				$entry->getArticleId(),
				$entry->getUserId(),
				$entry->getIPAddress(),
				$entry->getLogLevel(),
				$entry->getEventType(),
				$entry->getAssocType(),
				$entry->getAssocId(),
				$entry->getMessage()
			)
		);

		$entry->setLogId($this->getInsertLogId());
		return $entry->getLogId();
	}

	/**
	 * Delete a single log entry for an article.
	 * @param $logId int
	 * @param $articleId int optional
	 */
	function deleteLogEntry($logId, $articleId = null) {
		if (isset($articleId)) {
			return $this->update(
				'DELETE FROM article_event_log WHERE log_id = ? AND article_id = ?',
				array($logId, $articleId)
			);

		} else {
			return $this->update(
				'DELETE FROM article_event_log WHERE log_id = ?', $logId
			);
		}
	}

	/**
	 * Delete all log entries for an article.
	 * @param $articleId int
	 */
	function deleteArticleLogEntries($articleId) {
		return $this->update(
			'DELETE FROM article_event_log WHERE article_id = ?', $articleId
		);
	}

	/**
	 * Transfer all article log entries to another user.
	 * @param $articleId int
	 */
	function transferArticleLogEntries($oldUserId, $newUserId) {
		return $this->update(
			'UPDATE article_event_log SET user_id = ? WHERE user_id = ?',
			array($newUserId, $oldUserId)
		);
	}

	/**
	 * Get the ID of the last inserted log entry.
	 * @return int
	 */
	function getInsertLogId() {
		return $this->getInsertId('article_event_log', 'log_id');
	}
}

?>
