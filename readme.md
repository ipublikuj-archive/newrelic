# NewRelic

[![Build Status](https://img.shields.io/travis/iPublikuj/newrelic.svg?style=flat-square)](https://travis-ci.org/iPublikuj/newrelic)
[![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/iPublikuj/newrelic.svg?style=flat-square)](https://scrutinizer-ci.com/g/iPublikuj/newrelic/?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/iPublikuj/newrelic.svg?style=flat-square)](https://scrutinizer-ci.com/g/iPublikuj/newrelic/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/ipub/newrelic.svg?style=flat-square)](https://packagist.org/packages/ipub/newrelic)
[![Composer Downloads](https://img.shields.io/packagist/dt/ipub/newrelic.svg?style=flat-square)](https://packagist.org/packages/ipub/newrelic)
[![License](https://img.shields.io/packagist/l/ipub/newrelic.svg?style=flat-square)](https://packagist.org/packages/ipub/newrelic)

System logger for [NewRelic](http://www.newrelic.com/) service for [Nette Framework](http://nette.org/)

## Installation

The best way to install ipub/newrelic is using  [Composer](http://getcomposer.org/):

```sh
$ composer require ipub/newrelic
```

After that you have to register extension in config.neon.

```neon
extensions:
	newrelic: IPub\NewRelic\DI\NewRelicExtension
```
