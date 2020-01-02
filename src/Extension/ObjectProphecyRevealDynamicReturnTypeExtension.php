<?php

declare(strict_types=1);

namespace JanGregor\Prophecy\Extension;

use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

class ObjectProphecyRevealDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return 'Prophecy\Prophecy\ObjectProphecy';
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return 'reveal' === $methodReflection->getName();
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        $calledOnType = $scope->getType($methodCall->var);

        $returnType = $parametersAcceptor->getReturnType();

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $returnType;
        }

        $types = \array_map(static function (string $class): ObjectType {
            return new ObjectType($class);
        }, $calledOnType->getProphesizedClasses());

        $types[] = $returnType;

        return TypeCombinator::intersect(...$types);
    }
}
