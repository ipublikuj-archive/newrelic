<?php
/**
 * Logger.php
 *
 * @copyright	More in license.md
 * @license		http://www.ipublikuj.eu
 * @author		Adam Kadlec http://www.ipublikuj.eu
 * @package		iPublikuj:Framework!
 * @subpackage	Loggers
 * @since		5.0
 *
 * @date		12.03.14
 */

namespace IPub\NewRelic\Loggers;

use Tracy;

class Logger extends Tracy\Logger
{
	/**
	 * Logs message or exception to file and sends email notification.
	 *
	 * @param string|array
	 * @param  int one of constant self::INFO, WARNING, ERROR (sends email), EXCEPTION (sends email), CRITICAL (sends email)
	 *
	 * @return void
	 */
	public function log($message, $priority = self::INFO)
	{
		parent::log($message, $priority);

		// Log only errors
		if ($priority === self::ERROR || $priority === self::CRITICAL) {
			if (is_array($message)) {
				$message = implode(' ', $message);
			}

			newrelic_notice_error($message);
		}
	}
}