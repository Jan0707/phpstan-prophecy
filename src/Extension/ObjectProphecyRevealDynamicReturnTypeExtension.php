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
use PHPStan\Type;

/**
 * @internal
 */
final class ObjectProphecyRevealDynamicReturnTypeExtension implements Type\DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return 'Prophecy\Prophecy\ObjectProphecy';
    }

    public function isMethodSupported(Reflection\MethodReflection $methodReflection): bool
    {
        return 'reveal' === $methodReflection->getName();
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

        $types = \array_map(static function (string $class): Type\ObjectType {
            return new Type\ObjectType($class);
        }, $calledOnType->getProphesizedClasses());

        $types[] = $returnType;

        return Type\TypeCombinator::intersect(...$types);
    }
}
