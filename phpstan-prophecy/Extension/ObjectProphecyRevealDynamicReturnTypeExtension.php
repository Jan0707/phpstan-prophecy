<?php

namespace JanGregor\Prophecy\Extension;


use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use Prophecy\Prophecy\ObjectProphecy;

class ObjectProphecyRevealDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public static function getClass(): string
    {
        return ObjectProphecy::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'reveal';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $calledOnType = $scope->getType($methodCall->var);

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $methodReflection->getReturnType();
        }

        return new ObjectType($calledOnType->getProphesizedClass());
    }
}
