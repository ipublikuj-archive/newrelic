<?php
/**
 * OnStartupHandler.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:NewRelic!
 * @subpackage     Events
 * @since          1.0.0
 *
 * @date           25.05.15
 */

declare(strict_types = 1);

namespace IPub\NewRelic\Events;

use Nette;
use Nette\Application;

use Tracy\Debugger;

use IPub;
use IPub\NewRelic\Loggers;

/**
 * On application startuo event
 *
 * @package        iPublikuj:NewRelic!
 * @subpackage     Events
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
final class OnStartupHandler
{
	/**
	 * Implement nette smart magic
	 */
	use Nette\SmartObject;

	/**
	 * @param Application\Application $application
	 */
	public function __invoke(Application\Application $application) : void
	{
		// Check if new relict extension is loaded
		if (!extension_loaded('newrelic')) {
			return;
		}

		// Register new relic logger into tracy
		$logger = new Loggers\Logger();
		$logger->directory =& Debugger::$logDirectory;
		$logger->email =& Debugger::$email;

		Debugger::setLogger($logger);
	}
}
