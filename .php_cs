<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Jan Gregor Emge-Triebel
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Jan0707/phpstan-prophecy
 */

use Ergebnis\License;
use Ergebnis\PhpCsFixer\Config;

$license = License\Type\MIT::text(
    __DIR__ . '/LICENSE',
    License\Year::fromString('2018'),
    License\Holder::fromString('Jan Gregor Emge-Triebel'),
    License\Url::fromString('https://github.com/Jan0707/phpstan-prophecy')
);

$license->save();

$config = Config\Factory::fromRuleSet(new Config\RuleSet\Php71($license->header()), [
    'final_class' => false,
]);

$config->getFinder()
    ->ignoreDotFiles(false)
    ->in(__DIR__)
    ->exclude([
        '.github',
    ])
    ->name('.php_cs');

return $config;
