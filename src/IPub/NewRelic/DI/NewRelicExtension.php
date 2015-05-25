<?php
/**
 * NewRelicExtension.php
 *
 * @copyright	More in license.md
 * @license		http://www.ipublikuj.eu
 * @author		Adam Kadlec http://www.ipublikuj.eu
 * @package		iPublikuj:NewRelic!
 * @subpackage	DI
 * @since		5.0
 *
 * @date		25.05.15
 */

namespace IPub\NewRelic\DI;

use Nette;
use Nette\DI;
use Nette\PhpGenerator as Code;

class NewRelicExtension extends DI\CompilerExtension
{
	public function loadConfiguration()
	{
		// Get container builder
		$builder = $this->getContainerBuilder();

		// Register listener services
		$builder->addDefinition($this->prefix('onStartupHandler'))
			->setClass('IPub\NewRelic\Events\OnStartupHandler');

		$builder->addDefinition($this->prefix('onRequestHandler'))
			->setClass('IPub\NewRelic\Events\OnRequestHandler');

		$builder->addDefinition($this->prefix('onErrorHandler'))
			->setClass('IPub\NewRelic\Events\OnErrorHandler');

		// Register listeners into application
		$application = $builder->getDefinition('application');
		$application->addSetup('$service->onStartup[] = ?', array('@' . $this->prefix('onStartupHandler')));
		$application->addSetup('$service->onRequest[] = ?', array('@' . $this->prefix('onRequestHandler')));
		$application->addSetup('$service->onError[] = ?', array('@' . $this->prefix('onErrorHandler')));
	}

	/**
	 * @param Nette\Configurator $config
	 * @param string $extensionName
	 */
	public static function register(Nette\Configurator $config, $extensionName = 'newRelic')
	{
		$config->onCompile[] = function (Nette\Configurator $config, Nette\DI\Compiler $compiler) use ($extensionName) {
			$compiler->addExtension($extensionName, new NewRelicExtension());
		};
	}
}