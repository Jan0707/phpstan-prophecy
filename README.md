# phpstan-prophecy

[![Close](https://github.com/Jan0707/phpstan-prophecy/workflows/Close/badge.svg)](https://github.com/Jan0707/phpstan-prophecy/actions)
[![Integrate](https://github.com/Jan0707/phpstan-prophecy/workflows/Integrate/badge.svg)](https://github.com/Jan0707/phpstan-prophecy/actions)
[![Merge](https://github.com/Jan0707/phpstan-prophecy/workflows/Merge/badge.svg)](https://github.com/Jan0707/phpstan-prophecy/actions)
[![Triage](https://github.com/Jan0707/phpstan-prophecy/workflows/Triage/badge.svg)](https://github.com/Jan0707/phpstan-prophecy/actions)

[![Latest Stable Version](https://poser.pugx.org/jangregor/phpstan-prophecy/v/stable)](https://packagist.org/packages/jangregor/phpstan-prophecy)
[![Total Downloads](https://poser.pugx.org/jangregor/phpstan-prophecy/downloads)](https://packagist.org/packages/jangregor/phpstan-prophecy)

[![Violinist Enabled](https://img.shields.io/badge/violinist-enabled-brightgreen.svg)](https://violinist.io)

Provides a [`phpspec/prophecy`](https://github.com/phpspec/prophecy) extension for [`phpstan/phpstan`](https://github.com/phpstan/phpstan).

## Installation

Run

```shell
composer require --dev jangregor/phpstan-prophecy
```

## Configuration

### Automatic

When using [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer), no further setup is required.

### Manual

When not using [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer), [`extension.neon`](extension.neon) needs to be included in `phpstan.neon`:

```diff
 includes:
+	- vendor/jangregor/phpstan-prophecy/extension.neon
```

## Usage

### `prophesize()` and `reveal()`

```php
<?php

use PHPUnit\Framework;

final class ExampleTest extends Framework\TestCase
{
    private $prophecy;

    protected function setUp()
    {
        $this->prophecy = $this->prophesize(SomeModel::class);
    }

    public function testSomething(): void
    {
        $prophecy = $this->prophesize(SomeModel::class);

        $testDouble = $prophecy->reveal();

        // ...
    }

    public function testSomethingElse(): void
    {
        $testDouble = $this->prophecy->reveal();

        // ...
    }

    public function testSomethingDifferent(): void
    {
        $testDouble = $this->createProphecy()->reveal();

        // ...
    }

    private function createProphecy()
    {
        return $this->prophesize(SomeModel::class);
    }

}
```

:bulb: With this extension enabled, `phpstan/phpstan` will understand that `$testDouble` is an instance of `SomeModel`.

### `prophesize()`, `willExtend()`, and `reveal()`

```php
<?php

use PHPUnit\Framework;

final class ExampleTest extends Framework\TestCase
{
    private $prophecy;

    protected function setUp()
    {
        $this->prophecy = $this->prophesize()->willExtend(SomeModel::class);
    }

    public function testSomething(): void
    {
        $prophecy = $this->prophesize()->willExtend(SomeModel::class);

        $testDouble = $prophecy->reveal();

        // ...
    }

    public function testSomethingElse(): void
    {
        $testDouble = $this->prophecy->reveal();

        // ...
    }

    public function testSomethingDifferent(): void
    {
        $testDouble = $this->createProphecy()->reveal();

        // ...
    }

    private function createProphecy()
    {
        return $this->prophesize(SomeModel::class)->willExtend(SomeInterface::class);
    }
}
```

:bulb: With this extension enabled, `phpstan/phpstan` will understand that `$testDouble` is an instance of `SomeModel`.

### `prophesize()`, `willImplement()`, and `reveal()`

```php
<?php

use PHPUnit\Framework;

final class ExampleTest extends Framework\TestCase
{
    private $prophecy;

    protected function setUp()
    {
        $this->prophecy = $this->prophesize(SomeModel::class)->willImplement(SomeInterface::class);
    }

    public function testSomething(): void
    {
        $prophecy = $this->prophesize(SomeModel::class)->willImplement(SomeInterface::class);

        $testDouble = $prophecy->reveal();

        // ...
    }

    public function testSomethingElse(): void
    {
        $testDouble = $this->prophecy->reveal();

        // ...
    }

    public function testSomethingDifferent(): void
    {
        $testDouble = $this->createProphecy()->reveal();

        // ...
    }

    private function createProphecy()
    {
        return $this->prophesize(SomeModel::class)->willImplement(SomeInterface::class);
    }
}
```

:bulb: With this extension enabled, `phpstan/phpstan` will understand that `$testDouble` is an instance of `SomeModel` that also implements `SomeInterface`.

### Method Predictions

```php
<?php

use PHPUnit\Framework;

final class ExampleTest extends Framework\TestCase
{
    public function testSomething(): void
    {
        $prophecy = $this->prophesize(SomeModel::class);

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(4);

        $testDouble = $prophecy->reveal();

        // ...
    }
}
```

:bulb: With this extension enabled, `phpstan/phpstan` will understand that `$prophecy`  accepts method calls to all methods that are implemented by its prophesized class (or additionally implemented interfaces, when using `willImplement()`).

### Method Arguments

:exclamation: Currently here are no checks in place to validate the arguments of methods that are invoked on prophecies.

## Development

A development environment is provided via [`.docker/Dockerfile`](.docker/Dockerfile).

Run

```shell
$ docker build --tag phpstan-prophecy .docker/
```

to build and tag the Docker image.

Run

```shell
$ docker run -it --rm  --volume "$PWD":/var/www/html --workdir /var/www/html phpstan-prophecy bash
```

to open a shell in the Docker container.

## Changelog

Please have a look at [`CHANGELOG.md`](CHANGELOG.md).

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## License

This package is licensed using the MIT License.

Please have a look at [`LICENSE.md`](LICENSE.md).
