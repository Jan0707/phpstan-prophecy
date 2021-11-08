<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Jan Gregor Emge-Triebel
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/Jan0707/phpstan-prophecy
 */

namespace JanGregor\Prophecy\Type\ObjectProphecy;

use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type;
use Prophecy\Prophecy;

/**
 * @internal
 */
final class WillExtendOrImplementDynamicReturnTypeExtension implements Type\DynamicMethodReturnTypeExtension
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

        if (!$calledOnType instanceof Type\Generic\GenericObjectType) {
            return $returnType;
        }

        if (Prophecy\ObjectProphecy::class !== $calledOnType->getClassName()) {
            return $returnType;
        }

        if (0 === \count($methodCall->getArgs())) {
            return $returnType;
        }

        $argumentType = $scope->getType($methodCall->getArgs()[0]->value);

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

        return new Type\Generic\GenericObjectType(
            Prophecy\ObjectProphecy::class,
            [
                Type\TypeCombinator::intersect(
                    new Type\ObjectType($className),
                    ...$calledOnType->getTypes()
                ),
            ]
        );
    }
}
