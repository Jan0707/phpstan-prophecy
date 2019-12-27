<?php

use Ergebnis\PhpCsFixer\Config;

$config = Config\Factory::fromRuleSet(new Config\RuleSet\Php71(), [
    'declare_strict_types' => false,
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
