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

        $returnType = $parametersAcceptor->getReturnType();

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $returnType;
        }

        if (0 === \count($methodCall->args)) {
            return $returnType;
        }

        $argumentType = $scope->getType($methodCall->args[0]->value);

        if (!$argumentType instanceof ConstantStringType) {
            return $returnType;
        }

        $className = $argumentType->getValue();

        if (!$returnType instanceof TypeWithClassName) {
            throw new ShouldNotHappenException();
        }

        if ('static' === $className) {
            return $returnType;
        }

        if ('self' === $className && null !== $scope->getClassReflection()) {
            $className = $scope->getClassReflection()->getName();
        }

        $calledOnType->addProphesizedClass($className);

        return $calledOnType;
    }
}
