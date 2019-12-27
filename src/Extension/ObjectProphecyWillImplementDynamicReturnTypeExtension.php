<?php

namespace JanGregor\Prophecy\Extension;

use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use PHPStan\Type\TypeWithClassName;

class ObjectProphecyWillImplementDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return 'Prophecy\Prophecy\ObjectProphecy';
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return 'willImplement' === $methodReflection->getName();
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        $calledOnType = $scope->getType($methodCall->var);

        $prophecyType = $parametersAcceptor->getReturnType();

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $prophecyType;
        }

        if (0 === \count($methodCall->args)) {
            return $prophecyType;
        }

        $argType = $scope->getType($methodCall->args[0]->value);

        if (!($argType instanceof ConstantStringType)) {
            return $prophecyType;
        }

        $class = $argType->getValue();

        if (!($prophecyType instanceof TypeWithClassName)) {
            throw new ShouldNotHappenException();
        }

        if ('static' === $class) {
            return $prophecyType;
        }

        if ('self' === $class && null !== $scope->getClassReflection()) {
            $class = $scope->getClassReflection()->getName();
        }

        $calledOnType->addProphesizedClass($class);

        return $calledOnType;
    }
}
