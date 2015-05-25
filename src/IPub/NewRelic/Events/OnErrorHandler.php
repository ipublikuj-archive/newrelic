<?php
/**
 * OnErrorHandler.php
 *
 * @copyright	More in license.md
 * @license		http://www.ipublikuj.eu
 * @author		Adam Kadlec http://www.ipublikuj.eu
 * @package		iPublikuj:NewRelic!
 * @subpackage	Events
 * @since		5.0
 *
 * @date		25.05.14
 */

namespace IPub\NewRelic\Events;

use Kdyby;

use Nette;
use Nette\Application;

use IPub;

class OnErrorHandler extends Nette\Object
{
	/**
	 * @param Application\Application $app
	 * @param \Exception $ex
	 */
	public function __invoke(Application\Application $app, \Exception $ex)
	{
		// Check if new relict extension is loaded
		if (!extension_loaded('newrelic')) {
			return;
		}

		if ($ex instanceof Application\BadRequestException) {
			return; // Skip
		}

		// Log only errors with code 500
		newrelic_notice_error($ex->getMessage(), $ex);
	}
}