<?php

namespace JanGregor\Prophecy\Extension;


use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use Prophecy\Prophet;

class ProphetProphesizeDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public static function getClass(): string
    {
        var_dump('getClass');

        return Prophet::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        var_dump('isMethodSupported');

        return $methodReflection->getName() === 'prophesize';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        if (count($methodCall->args) === 0) {
            throw new \Exception('Cannot analyze prophecy without target class.');
        }

        $ObjectProphecyType = new ObjectProphecyType($methodCall->args[0]);

        return $ObjectProphecyType;
    }
}