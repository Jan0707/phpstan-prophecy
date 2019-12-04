[![Continuous Integration](https://github.com/Jan0707/phpstan-prophecy/workflows/Continuous%20Integration/badge.svg)](https://github.com/Jan0707/phpstan-prophecy/actions)
[![Violinist Enabled](https://img.shields.io/badge/violinist-enabled-brightgreen.svg)](https://violinist.io)

# PHPStan-Prophecy

## Introduction

PHPStan is a static code analysis tool for php, you can [find out more about it here](https://github.com/phpstan/phpstan).

This repository provides an extension so that it also understands code that uses the Prophecy library to fake objects in unit tests. So far it covers two use cases:

### Prophesizing and Revealing

```php
$prophecy = $prophet->prophesize(SomeModel::class);
$instance = $prophecy->reveal();
```

It will help PHPStan to understand that the `$instance` variable is indeed an instance of `SomeModel`.

### Method Predictions

```php
$prophecy = $prophet->prophesize(Calculator::class);
$prophecy->doubleTheNumber(Argument::is(2))->willReturn(5);

$instance = $prophecy->reveal();
$instance->doubleTheNumber(2); // Will return 5
```

It will also help PHPStan to understand that `$prophecy` accepts method calls to all methods that are implemented by its prophesized class.

**HINT:** Currently there are no checks in place to validate the arguments of methods that are being called on prophecies.

## Installation and usage

Install via composer:

```shell
composer require --dev jangregor/phpstan-prophecy
```

### Automatic Extension Setup

If you have the [PHPStan Extension Installer](https://github.com/phpstan/extension-installer) installed as well, there is no next step required.
Otherwise, please proceed with the manual setup step.

### Manual Setup

And then make sure to add the extension to your `phpstan.neon` file:

```neon
includes:
	- vendor/jangregor/phpstan-prophecy/src/extension.neon
```

And you should be good to go. Happy testing!

## Development

If you need a suitable dev environment you can always use docker.
Simply build the respective container and tag it via:

``docker build -t phpstan-prophecy:7.1 docker/container/php``

You can then use this tagged container image to run php during development:

``docker run -it --rm --name phpstan-prophecy-dev -v "$PWD":/var/www/html -w /var/www/html phpstan-prohphecy:7.1 bash``

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).
