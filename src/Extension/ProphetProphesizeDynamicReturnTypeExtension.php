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

class ProphetProphesizeDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function getClass(): string
    {
        return $this->className;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return 'prophesize' === $methodReflection->getName();
    }

    /**
     * @param MethodReflection $methodReflection
     * @param MethodCall       $methodCall
     * @param Scope            $scope
     *
     * @throws \PHPStan\ShouldNotHappenException
     *
     * @return Type
     */
    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): Type
    {
        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());
        $prophecyType = $parametersAcceptor->getReturnType();

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

        return new ObjectProphecyType($class);
    }
}
