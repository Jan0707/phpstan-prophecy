<?php

namespace JanGregor\Prophecy\Extension;

use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use Prophecy\Prophet;

class ProphetProphesizeDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public static function getClass(): string
    {
        return Prophet::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'prophesize';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        if (count($methodCall->args) === 0) {
            return $methodReflection->getReturnType();
        }

        $arg = $methodCall->args[0]->value;

        if (!($arg instanceof ClassConstFetch)) {
            return $methodReflection->getReturnType();
        }

        $class = $arg->class;

        if (!($class instanceof Name)) {
            return $methodReflection->getReturnType();
        }

        $class = (string) $class;

        if ($class === 'static') {
            return $methodReflection->getReturnType();
        }

        if ($class === 'self') {
            $class = $scope->getClassReflection()->getName();
        }

        $ObjectProphecyType = new ObjectProphecyType($class);

        return $ObjectProphecyType;
    }
}
