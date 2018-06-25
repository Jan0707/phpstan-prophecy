<?php

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
use Prophecy\Prophecy\ObjectProphecy;

class ObjectProphecyRevealDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return ObjectProphecy::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'reveal';
    }

    /**
     * @param MethodReflection $methodReflection
     * @param MethodCall $methodCall
     * @param Scope $scope
     * @return Type
     * @throws \PHPStan\ShouldNotHappenException
     */
    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $calledOnType = $scope->getType($methodCall->var);

        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $parametersAcceptor->getReturnType();
        }

        return TypeCombinator::intersect(
            new ObjectType($calledOnType->getProphesizedClass()),
            $parametersAcceptor->getReturnType()
        );
    }
}
