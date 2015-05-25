<?php
/**
 * OnRequestHandler.php
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

class OnRequestHandler extends Nette\Object
{
	/**
	 * @param Application\Application $app
	 * @param Application\Request $request
	 */
	public function __invoke(Application\Application $app, Application\Request $request)
	{
		// Check if new relict extension is loaded
		if (!extension_loaded('newrelic')) {
			return;
		}

		if (PHP_SAPI === 'cli') {
			// Save in human readable format
			newrelic_name_transaction('$ ' . basename($_SERVER['argv'][0]) . ' ' . implode(' ', array_slice($_SERVER['argv'], 1)));

			// Mark process as background job
			newrelic_background_job(TRUE);

			return;
		}

		// Get request info for naming exception
		$params = $request->getParameters();

		newrelic_name_transaction($request->getPresenterName() . (isset($params['action']) ? ':' . $params['action'] : ''));
	}
}