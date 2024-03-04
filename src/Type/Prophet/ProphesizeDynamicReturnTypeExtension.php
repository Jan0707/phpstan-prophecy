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

namespace JanGregor\Prophecy\Type\Prophet;

use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPStan\Type;
use Prophecy\Prophecy;

/**
 * @internal
 */
final class ProphesizeDynamicReturnTypeExtension implements Type\DynamicMethodReturnTypeExtension
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

    public function isMethodSupported(Reflection\MethodReflection $methodReflection): bool
    {
        return 'prophesize' === $methodReflection->getName();
    }

    public function getTypeFromMethodCall(
        Reflection\MethodReflection $methodReflection,
        Node\Expr\MethodCall $methodCall,
        Analyser\Scope $scope
    ): Type\Type {
        $parametersAcceptor = Reflection\ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        $returnType = $parametersAcceptor->getReturnType();

        if (0 === \count($methodCall->getArgs())) {
            return new Type\Generic\GenericObjectType(
                Prophecy\ObjectProphecy::class,
                []
            );
        }

        $argumentType = $scope->getType($methodCall->getArgs()[0]->value);

        if (!$argumentType instanceof Type\Constant\ConstantStringType) {
            return $returnType;
        }

        $className = $argumentType->getValue();

        if ('static' === $className) {
            return $returnType;
        }

        if ('self' === $className && null !== $scope->getClassReflection()) {
            $className = $scope->getClassReflection()->getName();
        }

        return new Type\Generic\GenericObjectType(
            Prophecy\ObjectProphecy::class,
            [
                new Type\ObjectType($className),
            ]
        );
    }
}
