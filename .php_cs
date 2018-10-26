<?php

$finder = PhpCsFixer\Finder::create()->in(__DIR__);

$config = PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRules([
        '@PSR2' => true,
    ]);

return $config;
