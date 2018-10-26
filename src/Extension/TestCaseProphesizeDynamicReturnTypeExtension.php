<?php

namespace JanGregor\Prophecy\Extension;

class TestCaseProphesizeDynamicReturnTypeExtension extends ProphetProphesizeDynamicReturnTypeExtension
{
    public function getClass(): string
    {
        return 'PHPUnit\Framework\TestCase';
    }
}
