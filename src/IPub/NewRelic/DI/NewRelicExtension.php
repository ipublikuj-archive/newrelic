<?php
/**
 * NewRelicExtension.php
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec https://www.ipublikuj.eu
 * @package        iPublikuj:NewRelic!
 * @subpackage     DI
 * @since          1.0.0
 *
 * @date           25.05.15
 */

declare(strict_types = 1);

namespace IPub\NewRelic\DI;

use Nette;
use Nette\DI;
use Nette\PhpGenerator as Code;

use IPub\NewRelic\Events;

/**
 * NewRelic extension container
 *
 * @package        iPublikuj:NewRelic!
 * @subpackage     DI
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
final class NewRelicExtension extends DI\CompilerExtension
{
	/**
	 * @return void
	 */
	public function loadConfiguration() : void
	{
		// Get container builder
		$builder = $this->getContainerBuilder();

		// Register listener services
		$builder->addDefinition($this->prefix('onStartupHandler'))
			->setClass(Events\OnStartupHandler::class);

		$builder->addDefinition($this->prefix('onRequestHandler'))
			->setClass(Events\OnRequestHandler::class);

		$builder->addDefinition($this->prefix('onErrorHandler'))
			->setClass(Events\OnErrorHandler::class);

		// Register listeners into application
		$application = $builder->getDefinition('application');
		$application->addSetup('$service->onStartup[] = ?', ['@' . $this->prefix('onStartupHandler')]);
		$application->addSetup('$service->onRequest[] = ?', ['@' . $this->prefix('onRequestHandler')]);
		$application->addSetup('$service->onError[] = ?', ['@' . $this->prefix('onErrorHandler')]);
	}

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 *
	 * @return void
	 */
	public static function register(Nette\Configurator $config, string $extensionName = 'newRelic') : void
	{
		$config->onCompile[] = function (Nette\Configurator $config, Nette\DI\Compiler $compiler) use ($extensionName) {
			$compiler->addExtension($extensionName, new NewRelicExtension());
		};
	}
}
