# NewRelic

[![Latest Stable Version](https://img.shields.io/packagist/v/ipub/newrelic.svg?style=flat-square)](https://packagist.org/packages/ipub/newrelic)
[![Composer Downloads](https://img.shields.io/packagist/dt/ipub/newrelic.svg?style=flat-square)](https://packagist.org/packages/ipub/newrelic)

Add ability to monitor you application based on [Nette Framework](http://nette.org/) with [NewRelic](http://www.newrelic.com/) service

## Installation

The best way to install ipub/newrelic is using  [Composer](http://getcomposer.org/):

```json
{
	"require": {
		"ipub/newrelic": "dev-master"
	}
}
```

or

```sh
$ composer require ipub/newrelic:@dev
```

After that you have to register extension in config.neon.

```neon
extensions:
	newrelic: IPub\NewRelic\DI\NewRelicExtension
```