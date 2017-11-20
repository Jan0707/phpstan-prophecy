<?php

namespace JanGregor\Prophecy\Extension;

use PHPUnit\Framework\TestCase;

class TestCaseProphesizeDynamicReturnTypeExtension extends  ProphetProphesizeDynamicReturnTypeExtension
{
    public function getClass(): string
    {
        return TestCase::class;
    }
}
