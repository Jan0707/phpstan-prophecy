# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`1.0.0...main`][1.0.0...master].

## [`1.0.0`][1.0.0]

For a full diff see [`0.8.1...1.0.0`][0.8.1...1.0.0].

### Changed

- Added support for `phpstan/phpstan:^1.0.0` and dropped support for non-stable versions of `phpstan/phpstan` ([#266]), by [@alexander-schranz]

## [`0.8.1`][0.8.1]

For a full diff see [`0.8.0...0.8.1`][0.8.0...0.8.1].

### Changed

- Allowed installation with PHP 8.0 ([#236]), by [@localheinz]

## [`0.8.0`][0.8.0]

For a full diff see [`0.7.0...0.8.0`][0.7.0...0.8.0].

### Removed

- Removed the symbolic link from `src/extension.neon` to `extension.neon` ([#182]), by [@localheinz]

  When using [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer), no changes on your end are required.

  When not using [`phpstan/extension-installer`](https://github.com/phpstan/extension-installer), you need to adjust `phpstan.neon`:

  ```diff
   includes:
  -	- vendor/jangregor/phpstan-prophecy/src/extension.neon
  +	- vendor/jangregor/phpstan-prophecy/extension.neon
  ```

## [`0.7.0`][0.7.0]

For a full diff see [`0.6.2...0.7.0`][0.6.2...0.7.0].

### Changed

- Moved `src/extension.neon` to `extension.neon` ([#140]), by [@localheinz]
- Marked classes as `@internal` ([#144]), by [@localheinz]
- Moved and renamed internal classes ([#153]), by [@localheinz]
- Required `phpstan/phpstan:~0.12.6` ([#165]), by [@Jean85]
- Simplified extension by making use of generics ([#165]), by [@Jean85] and [@ondrejmirtes]

## [`0.6.2`][0.6.2]

For a full diff see [`0.6.1...0.6.2`][0.6.1...0.6.2].

### Fixed

- Allowed installation with `phpunit/phpunit:^9` ([#124]), by [@localheinz]

## [`0.6.1`][0.6.1]

For a full diff see [`0.6.0...0.6.1`][0.6.0...0.6.1].

### Changed

- Marked classes as `final` ([#118]), by [@localheinz]
- Modified return value of `ObjectPropecyMethodReflection::hasSideEffects()` as invoking methods on an instance of `Prophecy\Prophecy\ObjectProphecy` might have side effects ([#119]), by [@localheinz]

## [`0.6.0`][0.6.0]

For a full diff see [`0.5.1...0.6.0`][0.5.1...0.6.0].

### Added

- Support for `willImplement()` ([#92]), by [@localheinz]
- Support for `willExtend()` ([#94]), by [@localheinz]

## [`0.5.1`][0.5.1]

For a full diff see [`0.5.0...0.5.1`][0.5.0...0.5.1].

### Changed

- Required at least `phpstan/phpstan:^0.12.0` ([#79]), by [@localheinz]

## [`0.5.0`][0.5.0]

For a full diff see [`0.4.2...0.5.0`][0.4.2...0.5.0].

### Added

- Allowed installation with `phpstan/phpstan:~0.12.2` ([#67]), by [@localheinz] and [@PedroTroller]

## [`0.4.2`][0.4.2]

For a full diff see [`0.4.1...0.4.2`][0.4.1...0.4.2].

## [`0.4.1`][0.4.1]

For a full diff see [`0.4...0.4.1`][0.4...0.4.1].

## [`0.4`][0.4]

For a full diff see [`0.3.0...0.4`][0.3.0...0.4].

## [`0.3.0`][0.3.0]

For a full diff see [`0.2.0...0.3.0`][0.2.0...0.3.0].

## [`0.2.0`][0.2.0]

For a full diff see [`0.1.2...0.2.0`][0.1.2...0.2.0].

## [`0.1.2`][0.1.2]

For a full diff see [`0.1.1...0.1.2`][0.1.1...0.1.2].

## [`0.1.1`][0.1.1]

For a full diff see [`0.1...0.1.1`][0.1...0.1.1].

## [`0.1`][0.1]

For a full diff see [`afd6fd9...0.1`][afd6fd9...0.1].

[0.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.1
[0.1.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.1.1
[0.1.2]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.1.2
[0.2.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.2.0
[0.3.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.3.0
[0.4]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.4
[0.4.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.4.1
[0.4.2]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.4.2
[0.5.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.5.0
[0.5.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.5.1
[0.6.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.6.0
[0.6.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.6.1
[0.6.2]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.6.2
[0.7.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.7.0
[0.8.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.8.0
[0.8.1]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/0.8.1
[1.0.0]: https://github.com/Jan0707/phpstan-prophecy/releases/tag/1.0.0

[afd6fd9...0.1]: https://github.com/Jan0707/phpstan-prophecy/compare/afd6fd9...0.1
[0.1...0.1.1]: https://github.com/Jan0707/phpstan-prophecy/compare/0.1...0.1.1
[0.1.1...0.1.2]: https://github.com/Jan0707/phpstan-prophecy/compare/0.1.1...0.1.2
[0.1.2...0.2.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.1.2...0.2.0
[0.2.0...0.3.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.2.0...0.3.0
[0.3.0...0.4]: https://github.com/Jan0707/phpstan-prophecy/compare/0.3.0...0.4
[0.4...0.4.1]: https://github.com/Jan0707/phpstan-prophecy/compare/0.4...0.4.1
[0.4.1...0.4.2]: https://github.com/Jan0707/phpstan-prophecy/compare/0.4.1...0.4.2
[0.4.2...0.5.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.4.2...0.5.0
[0.5.0...0.5.1]: https://github.com/Jan0707/phpstan-prophecy/compare/0.5.0...0.5.1
[0.5.1...0.6.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.5.1...0.6.0
[0.6.0...0.6.1]: https://github.com/Jan0707/phpstan-prophecy/compare/0.6.0...0.6.1
[0.6.1...0.6.2]: https://github.com/Jan0707/phpstan-prophecy/compare/0.6.1...0.6.2
[0.6.2...0.7.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.6.2...0.7.0
[0.7.0...0.8.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.7.0...0.8.0
[0.8.0...0.8.1]: https://github.com/Jan0707/phpstan-prophecy/compare/0.8.0...0.8.1
[0.8.1...1.0.0]: https://github.com/Jan0707/phpstan-prophecy/compare/0.8.1...1.0.0
[1.0.0...master]: https://github.com/Jan0707/phpstan-prophecy/compare/1.0.0...master

[#67]: https://github.com/Jan0707/phpstan-prophecy/pull/67
[#79]: https://github.com/Jan0707/phpstan-prophecy/pull/79
[#92]: https://github.com/Jan0707/phpstan-prophecy/pull/92
[#94]: https://github.com/Jan0707/phpstan-prophecy/pull/94
[#118]: https://github.com/Jan0707/phpstan-prophecy/pull/118
[#119]: https://github.com/Jan0707/phpstan-prophecy/pull/119
[#124]: https://github.com/Jan0707/phpstan-prophecy/pull/124
[#140]: https://github.com/Jan0707/phpstan-prophecy/pull/140
[#144]: https://github.com/Jan0707/phpstan-prophecy/pull/144
[#153]: https://github.com/Jan0707/phpstan-prophecy/pull/153
[#165]: https://github.com/Jan0707/phpstan-prophecy/pull/165
[#182]: https://github.com/Jan0707/phpstan-prophecy/pull/182
[#236]: https://github.com/Jan0707/phpstan-prophecy/pull/236
[#266]: https://github.com/Jan0707/phpstan-prophecy/pull/266

[@alexander-schranz]: https://github.com/alexander-schranz
[@Jean85]: https://github.com/Jean85
[@localheinz]: https://github.com/localheinz
[@ondrejmirtes ]: https://github.com/ondrejmirtes
[@PedroTroller]: https://github.com/PedroTroller
