<?php
/**
 * Test: IPub\NewRelic\Extension
 * @testCase
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:NewRelic!
 * @subpackage     Tests
 * @since          1.0.0
 *
 * @date           13.01.17
 */

declare(strict_types = 1);

namespace IPubTests\NewRelic;

use Nette;

use Tester;
use Tester\Assert;

use IPub;
use IPub\NewRelic;
use IPub\NewRelic\Events;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php';

class ExtensionTest extends Tester\TestCase
{
	public function testFunctional()
	{
		$dic = $this->createContainer();

		Assert::true($dic->getService('gravatar.onStartupHandler') instanceof Events\OnStartupHandler);
		Assert::true($dic->getService('gravatar.onRequestHandler') instanceof Events\OnRequestHandler);
		Assert::true($dic->getService('gravatar.onErrorHandler') instanceof Events\OnErrorHandler);
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer() : Nette\DI\Container
	{
		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		NewRelic\DI\NewRelicExtension::register($config);

		return $config->createContainer();
	}
}

\run(new ExtensionTest());