<?php

/**
 * @file SubscriptionDAO.inc.php
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package subscription
 * @class SubscriptionDAO
 *
 * Class for Subscription DAO.
 * Operations for retrieving and modifying Subscription objects.
 *
 * $Id: SubscriptionDAO.inc.php,v 1.25 2007/12/07 00:52:16 asmecher Exp $
 */

import('subscription.Subscription');
import('subscription.SubscriptionType');

class SubscriptionDAO extends DAO {
	/**
	 * Retrieve a subscription by subscription ID.
	 * @param $subscriptionId int
	 * @return Subscription
	 */
	function &getSubscription($subscriptionId) {
		$result = &$this->retrieve(
			'SELECT * FROM subscriptions WHERE subscription_id = ?', $subscriptionId
		);

		$returner = null;
		if ($result->RecordCount() != 0) {
			$returner = &$this->_returnSubscriptionFromRow($result->GetRowAssoc(false));
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Retrieve subscription journal ID by subscription ID.
	 * @param $subscriptionId int
	 * @return int
	 */
	function getSubscriptionJournalId($subscriptionId) {
		$result = &$this->retrieve(
			'SELECT journal_id FROM subscriptions WHERE subscription_id = ?', $subscriptionId
		);

		$returner = isset($result->fields[0]) ? $result->fields[0] : false;	

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Retrieve subscription ID by user ID.
	 * @param $userId int
	 * @param $journalId int
	 * @return int
	 */
	function getSubscriptionIdByUser($userId, $journalId) {
		$result = &$this->retrieve(
			'SELECT subscription_id
				FROM subscriptions
				WHERE user_id = ?
				AND journal_id = ?',
			array(
				$userId,
				$journalId
			)
		);

		$returner = isset($result->fields[0]) ? $result->fields[0] : false;	

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Check if a subscription exists for a given user and journal.
	 * @param $userId int
	 * @param $journalId int
	 * @return boolean
	 */
	function subscriptionExistsByUser($userId, $journalId) {
		$result = &$this->retrieve(
			'SELECT COUNT(*)
				FROM subscriptions
				WHERE user_id = ?
				AND   journal_id = ?',
			array(
				$userId,
				$journalId
			)
		);

		$returner = isset($result->fields[0]) && $result->fields[0] != 0 ? true : false;

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Internal function to return a Subscription object from a row.
	 * @param $row array
	 * @return Subscription
	 */
	function &_returnSubscriptionFromRow(&$row) {
		$subscription = &new Subscription();
		$subscription->setSubscriptionId($row['subscription_id']);
		$subscription->setJournalId($row['journal_id']);
		$subscription->setUserId($row['user_id']);
		$subscription->setTypeId($row['type_id']);
		$subscription->setDateStart($this->dateFromDB($row['date_start']));
		$subscription->setDateEnd($this->dateFromDB($row['date_end']));
		$subscription->setMembership($row['membership']);
		$subscription->setDomain($row['domain']);
		$subscription->setIPRange($row['ip_range']);

		HookRegistry::call('SubscriptionDAO::_returnSubscriptionFromRow', array(&$subscription, &$row));

		return $subscription;
	}

	/**
	 * Insert a new Subscription.
	 * @param $subscription Subscription
	 * @return int 
	 */
	function insertSubscription(&$subscription) {
		$returner = $this->update(
			sprintf('INSERT INTO subscriptions
				(journal_id, user_id, type_id, date_start, date_end, membership, domain, ip_range)
				VALUES
				(?, ?, ?, %s, %s, ?, ?, ?)',
				$this->dateToDB($subscription->getDateStart()), $this->dateToDB($subscription->getDateEnd())),
			array(
				$subscription->getJournalId(),
				$subscription->getUserId(),
				$subscription->getTypeId(),
				$subscription->getMembership(),
				$subscription->getDomain(),
				$subscription->getIPRange()
			)
		);

		$subscriptionId = $this->getInsertSubscriptionId();
		$subscription->setSubscriptionId($subscriptionId);

		if ($returner) {
			$this->insertSubscriptionIPRange($subscriptionId, $subscription->getIPRange());
		}

		return $subscriptionId;
	}

	/**
	 * Update an existing subscription.
	 * @param $subscription Subscription
	 * @return boolean
	 */
	function updateSubscription(&$subscription) {
		$subscriptionId = $subscription->getSubscriptionId();

		$returner = $this->update(
			sprintf('UPDATE subscriptions
				SET
					journal_id = ?,
					user_id = ?,
					type_id = ?,
					date_start = %s,
					date_end = %s,
					membership = ?,
					domain = ?,
					ip_range = ?
				WHERE subscription_id = ?',
				$this->dateToDB($subscription->getDateStart()), $this->dateToDB($subscription->getDateEnd())),
			array(
				$subscription->getJournalId(),
				$subscription->getUserId(),
				$subscription->getTypeId(),
				$subscription->getMembership(),
				$subscription->getDomain(),
				$subscription->getIPRange(),
				$subscriptionId
			)
		);

		if ($returner) {
			$this->deleteSubscriptionIPRangeBySubscriptionId($subscriptionId);
			$this->insertSubscriptionIPRange($subscriptionId, $subscription->getIPRange());
		}

		return $returner;
	}

	/**
	 * Renew a subscription by dateEnd + duration of subscription type
	 * if the subscription is expired, renew to current date + duration  
	 * @param $subscription Subscription
	 * @return boolean
	 */	
	function renewSubscription(&$subscription){
		$subscriptionTypeDAO =& DAORegistry::getDAO('SubscriptionTypeDAO');
		$subscriptionType =& $subscriptionTypeDAO->getSubscriptionType($subscription->getTypeId());
		
		$duration = $subscriptionType->getDuration();
		$dateEnd = strtotime($subscription->getDateEnd());
		
		// if the subscription is expired, extend it to today + duration of subscription
		$time = time();
		if ($dateEnd < $time ) $dateEnd = $time;

		$subscription->setDateEnd($this->dateToDB(mktime(0, 0, 0, date("m", $dateEnd)+$duration, date("d", $dateEnd), date("Y", $dateEnd))));
		$this->updateSubscription($subscription);
	}

	/**
	 * Delete a subscription by subscription ID.
	 * @param $subscriptionId int
	 * @return boolean
	 */
	function deleteSubscriptionById($subscriptionId) {
		$this->deleteSubscriptionIPRangeBySubscriptionId($subscriptionId);

		return $this->update(
			'DELETE FROM subscriptions WHERE subscription_id = ?', $subscriptionId
		);
	}

	/**
	 * Delete subscriptions by journal ID.
	 * @param $journalId int
	 * @return boolean
	 */
	function deleteSubscriptionsByJournal($journalId) {
		$result = &$this->retrieve(
			'SELECT subscription_id
			 FROM   subscriptions
			 WHERE  journal_id = ?',
			 $journalId
		);

		if ($result->RecordCount() != 0) {
			while (!$result->EOF) {
				$subscriptionId = $result->fields[0];
				$this->deleteSubscriptionIPRangeBySubscriptionId($subscriptionId);
				$result->moveNext();
			}
		}

		$result->Close();
		unset($result);

		return $this->update(
			'DELETE FROM subscriptions WHERE journal_id = ?', $journalId
		);
	}

	/**
	 * Delete subscriptions by user ID.
	 * @param $userId int
	 * @return boolean
	 */
	function deleteSubscriptionsByUserId($userId) {
		$result = &$this->retrieve(
			'SELECT subscription_id
			 FROM   subscriptions
			 WHERE  user_id = ?',
			 $userId
		);

		if ($result->RecordCount() != 0) {
			while (!$result->EOF) {
				$subscriptionId = $result->fields[0];
				$this->deleteSubscriptionIPRangeBySubscriptionId($subscriptionId);
				$result->moveNext();
			}
		}

		$result->Close();
		unset($result);

		return $this->update(
			'DELETE FROM subscriptions WHERE user_id = ?', $userId
		);
	}

	/**
	 * Delete all subscriptions by subscription type ID.
	 * @param $subscriptionTypeId int
	 * @return boolean
	 */
	function deleteSubscriptionByTypeId($subscriptionTypeId) {
		$result = &$this->retrieve(
			'SELECT subscription_id
			 FROM   subscriptions
			 WHERE  type_id = ?',
			 $subscriptionTypeId
		);

		if ($result->RecordCount() != 0) {
			while (!$result->EOF) {
				$subscriptionId = $result->fields[0];
				$this->deleteSubscriptionIPRangeBySubscriptionId($subscriptionId);
				$result->moveNext();
			}
		}

		$result->Close();
		unset($result);

		return $this->update(
			'DELETE FROM subscriptions WHERE type_id = ?', $subscriptionTypeId
		);
	}

	/**
	 * Retrieve all subscriptions.
	 * @return object DAOResultFactory containing Subscriptions
	 */
	function &getSubscriptions($rangeInfo = null) {
		$result = &$this->retrieveRange(
			'SELECT s.* FROM subscriptions s, users u WHERE s.user_id = u.user_id ORDER BY u.last_name ASC', false, $rangeInfo
		);

		$returner = &new DAOResultFactory($result, $this, '_returnSubscriptionFromRow');

		return $returner;
	}

	/**
	 * Retrieve subscriptions matching a particular journal ID.
	 * @param $journalId int
	 * @return object DAOResultFactory containing matching Subscriptions
	 */
	function &getSubscriptionsByJournalId($journalId, $rangeInfo = null) {
		$result = &$this->retrieveRange(
			'SELECT s.* FROM subscriptions s, users u WHERE s.user_id = u.user_id AND journal_id = ? ORDER BY u.last_name ASC', $journalId, $rangeInfo
		);

		$returner = &new DAOResultFactory($result, $this, '_returnSubscriptionFromRow');

		return $returner;
	}

	/**
	 * Retrieve subscriptions matching a particular end date and journal ID.
	 * @param $dateEnd date (YYYY-MM-DD)
	 * @param $journalId int
	 * @return object DAOResultFactory containing matching Subscriptions
	 */
	function &getSubscriptionsByDateEnd($dateEnd, $journalId, $rangeInfo = null) {
		$dateEnd = explode('-', $dateEnd);

		$result = &$this->retrieveRange(
			'SELECT	s.*
			FROM	subscriptions s,
				users u
			WHERE	u.user_id = s.user_id AND
				EXTRACT(YEAR FROM date_end) = ? AND
				EXTRACT(MONTH FROM date_end) = ? AND
				EXTRACT(DAY FROM date_end) = ? AND
				journal_id = ?
			ORDER BY u.last_name ASC',
			array(
				$dateEnd[0],
				$dateEnd[1],
				$dateEnd[2],
				$journalId
			), $rangeInfo
		);

		$returner = &new DAOResultFactory($result, $this, '_returnSubscriptionFromRow');

		return $returner;
	}

	/**
	 * Insert a new subscription IP range.
	 * @param $subscriptionId int
	 * @param $IP string
	 * @return boolean 
	 */
	function insertSubscriptionIPRange($subscriptionId, $IP) {
		if (empty($IP)) {
			return true;
		}

		if (empty($subscriptionId)) {
			return false;
		}

		// Get all IPs and IP ranges
		$ipRanges = explode(SUBSCRIPTION_IP_RANGE_SEPERATOR, $IP);

		$returner = true;
		
		while (list(, $curIPString) = each($ipRanges)) {
			$ipStart = null;
			$ipEnd = null;

			// Parse and check single IP string
			if (strpos($curIPString, SUBSCRIPTION_IP_RANGE_RANGE) === false) {

				// Check for wildcards in IP
				if (strpos($curIPString, SUBSCRIPTION_IP_RANGE_WILDCARD) === false) {

					// Get non-CIDR IP
					if (strpos($curIPString, '/') === false) {
						$ipStart = sprintf("%u", ip2long(trim($curIPString)));

					// Convert CIDR IP to IP range
					} else {
						list($curIPString, $cidrBits) = explode('/', trim($curIPString));

						if ($cidrBits == 0) {
							$cidrMask = 0;
						} else {
							$cidrMask = (0xffffffff << (32 - $cidrBits));
						}

						$ipStart = sprintf('%u', ip2long($curIPString) & $cidrMask);

						if ($cidrBits != 32) {
							$ipEnd = sprintf('%u', ip2long($curIPString) | (~$cidrMask & 0xffffffff));
						}
					}

				// Convert wildcard IP to IP range
				} else {
					$ipStart = sprintf('%u', ip2long(str_replace(SUBSCRIPTION_IP_RANGE_WILDCARD, '0', trim($curIPString))));
					$ipEnd = sprintf('%u', ip2long(str_replace(SUBSCRIPTION_IP_RANGE_WILDCARD, '255', trim($curIPString)))); 
				}

			// Convert wildcard IP range to IP range
			} else {
				list($ipStart, $ipEnd) = explode(SUBSCRIPTION_IP_RANGE_RANGE, $curIPString);

				// Replace wildcards in start and end of range
				$ipStart = sprintf('%u', ip2long(str_replace(SUBSCRIPTION_IP_RANGE_WILDCARD, '0', trim($ipStart))));
				$ipEnd = sprintf('%u', ip2long(str_replace(SUBSCRIPTION_IP_RANGE_WILDCARD, '255', trim($ipEnd))));
			}

			// Insert IP or IP range
			if (($ipStart != null) && ($returner)) {
				$returner = $this->update(
					sprintf('INSERT INTO subscription_ip
						(subscription_id, ip_start, ip_end)
						VALUES
						(?, ?, ?)'),
					array(
						$subscriptionId,
						$ipStart,
						$ipEnd
					) 
				);
			} else {
				$returner = false;
				break;
			}

		}

		return $returner;
	}

	/**
	 * Delete a subscription ip range by subscription ID.
	 * @param $subscriptionId int
	 * @return boolean
	 */
	function deleteSubscriptionIPRangeBySubscriptionId($subscriptionId) {
		return $this->update(
			'DELETE FROM subscription_ip WHERE subscription_id = ?', $subscriptionId
		);
	}

	/**
	 * Check whether there is a valid subscription for a given journal.
	 * @param $domain string
	 * @param $IP string
	 * @param $userId int
	 * @param $journalId int
	 * @return int
	 */
	function isValidSubscription($domain, $IP, $userId, $journalId) {
		$valid = false;

		if ($userId != null) {
			$valid = $this->isValidSubscriptionByUser($userId, $journalId);
			if ($valid !== false) { return $valid; }
		}

		if ($domain != null) {
			$valid = $this->isValidSubscriptionByDomain($domain, $journalId);
			if ($valid !== false) { return $valid; }
		}	

		if ($IP != null) {
			$valid = $this->isValidSubscriptionByIP($IP, $journalId);
			if ($valid !== false) { return $valid; }
		}

		return false;
    }

	/**
	 * Check whether user with ID has a valid subscription for a given journal.
	 * @param $userId int
	 * @param $journalId int
	 * @return int 
	 */
	function isValidSubscriptionByUser($userId, $journalId) {
		$checkDate = $this->dateToDB(Core::getCurrentDate());

		$result = &$this->retrieve(
			sprintf('SELECT subscription_id
				FROM subscriptions, subscription_types
				WHERE subscriptions.user_id = ?
				AND   subscriptions.journal_id = ?
				AND   %s >= date_start AND %s <= date_end  
				AND   subscriptions.type_id = subscription_types.type_id
				AND   (subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_ONLINE .' OR subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE . ')',
				$checkDate, $checkDate),
			array(
				$userId,
				$journalId
			));

		if ($result->RecordCount() != 0) {
			$returner = $result->fields[0];
		} else {
			$returner = false;
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Check whether there is a valid subscription with given domain for a journal.
	 * @param $domain string
	 * @param $journalId int
	 * @return int
	 */
	function isValidSubscriptionByDomain($domain, $journalId) {
		$checkDate = $this->dateToDB(Core::getCurrentDate());

		$result = &$this->retrieve(
			sprintf('SELECT subscription_id 
				FROM subscriptions, subscription_types
				WHERE POSITION(UPPER(LPAD(domain, LENGTH(domain)+1, \'.\')) IN UPPER(LPAD(?, LENGTH(?)+1, \'.\'))) != 0
				AND   domain != \'\'
				AND   subscriptions.journal_id = ?
				AND   %s >= date_start AND %s <= date_end  
				AND   subscriptions.type_id = subscription_types.type_id
				AND   subscription_types.institutional = 1
				AND   (subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_ONLINE .' OR subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE . ')',
				$checkDate, $checkDate),
			array(
				$domain,
				$domain,
				$journalId
			));

		if ($result->RecordCount() != 0) {
			$returner = $result->fields[0];
		} else {
			$returner = false;
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Check whether there is a valid subscription for the given IP for a journal.
	 * @param $IP string
	 * @param $journalId int
	 * @return int
	 */
	function isValidSubscriptionByIP($IP, $journalId) {
		if (empty($IP) || empty($journalId)) {
			return false;
		}

		$IP = sprintf('%u', ip2long($IP));
		$checkDate = $this->dateToDB(Core::getCurrentDate());

		$result = &$this->retrieve(
			sprintf('SELECT subscription_ip.subscription_id
				FROM subscription_ip, subscriptions, subscription_types
				WHERE ((ip_end IS NOT NULL
				AND   ? >= ip_start AND ? <= ip_end
				AND   subscription_ip.subscription_id = subscriptions.subscription_id   
				AND   subscriptions.journal_id = ?
				AND   %s >= date_start AND %s <= date_end  
				AND   subscriptions.type_id = subscription_types.type_id
				AND   subscription_types.institutional = 1
				AND   (subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_ONLINE .' OR subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE . '))
				OR    (ip_end IS NULL
				AND   ? = ip_start
				AND   subscription_ip.subscription_id = subscriptions.subscription_id   
				AND   subscriptions.journal_id = ?
				AND   %s >= date_start AND %s <= date_end  
				AND   subscriptions.type_id = subscription_types.type_id
				AND   subscription_types.institutional = 1
				AND   (subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_ONLINE .' OR subscription_types.format = ' . SUBSCRIPTION_TYPE_FORMAT_PRINT_ONLINE . ')))',
				$checkDate, $checkDate, $checkDate, $checkDate),
			array (
					$IP,
					$IP,
					$journalId,
					$IP,
					$journalId
			));

		if ($result->RecordCount() != 0) {
			$returner = $result->fields[0];
		} else {
			$returner = false;
		}

		$result->Close();
		unset($result);

		return $returner;
	}

	/**
	 * Get the ID of the last inserted subscription.
	 * @return int
	 */
	function getInsertSubscriptionId() {
		return $this->getInsertId('subscriptions', 'subscription_id');
	}
}

?>
