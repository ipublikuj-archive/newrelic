<?php
/**
 * OnErrorHandler.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
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
 * On application error event
 *
 * @package        iPublikuj:NewRelic!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
final class OnErrorHandler extends Nette\Object
{
	/**
	 * @param Application\Application $app
	 * @param \Exception|\TypeError $ex
	 *
	 * @return void
	 */
	public function __invoke(Application\Application $app, $ex)
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
