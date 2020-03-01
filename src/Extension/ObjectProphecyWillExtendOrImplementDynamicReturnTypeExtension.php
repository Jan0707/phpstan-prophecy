<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Jan Gregor Emge-Triebel
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/Jan0707/phpstan-prophecy
 */

namespace JanGregor\Prophecy\Extension;

use JanGregor\Prophecy\Type\ObjectProphecyType;
use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type;

/**
 * @internal
 */
final class ObjectProphecyWillExtendOrImplementDynamicReturnTypeExtension implements Type\DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return 'Prophecy\Prophecy\ObjectProphecy';
    }

    public function isMethodSupported(Reflection\MethodReflection $methodReflection): bool
    {
        $methodNames = [
            'willExtend',
            'willImplement',
        ];

        return \in_array(
            $methodReflection->getName(),
            $methodNames,
            true
        );
    }

    public function getTypeFromMethodCall(
        Reflection\MethodReflection $methodReflection,
        Node\Expr\MethodCall $methodCall,
        Analyser\Scope $scope
    ): Type\Type {
        $parametersAcceptor = Reflection\ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        $calledOnType = $scope->getType($methodCall->var);

        $returnType = $parametersAcceptor->getReturnType();

        if (!$calledOnType instanceof ObjectProphecyType) {
            return $returnType;
        }

        if (0 === \count($methodCall->args)) {
            return $returnType;
        }

        $argumentType = $scope->getType($methodCall->args[0]->value);

        if (!$argumentType instanceof Type\Constant\ConstantStringType) {
            return $returnType;
        }

        $className = $argumentType->getValue();

        if (!$returnType instanceof Type\TypeWithClassName) {
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
