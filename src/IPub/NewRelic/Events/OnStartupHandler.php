<?php
/**
 * OnStartupHandler.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
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
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
final class OnStartupHandler extends Nette\Object
{
	/**
	 * @param Application\Application $application
	 */
	public function __invoke(Application\Application $application)
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
