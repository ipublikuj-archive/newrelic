<?php
/**
 * OnRequestHandler.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:NewRelic!
 * @subpackage     Events
 * @since          1.0.0
 *
 * @date           25.05.14
 */

declare(strict_types = 1);

namespace IPub\NewRelic\Events;

use Nette;
use Nette\Application;

/**
 * On application request event
 *
 * @package        iPublikuj:NewRelic!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
final class OnRequestHandler
{
	/**
	 * Implement nette smart magic
	 */
	use Nette\SmartObject;

	/**
	 * @param Application\Application $application
	 * @param Application\Request $request
	 */
	public function __invoke(Application\Application $application, Application\Request $request) : void
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
