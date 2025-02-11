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
            true,
        );
    }

    public function getTypeFromMethodCall(
        Reflection\MethodReflection $methodReflection,
        Node\Expr\MethodCall $methodCall,
        Analyser\Scope $scope
    ): ?Type\Type {
        $args = $methodCall->getArgs();
        if (0 === \count($args)) {
            return null;
        }

        $calledOnType = $scope->getType($methodCall->var);
        $templateObjectType = $calledOnType->getTemplateType(Prophecy\ObjectProphecy::class, 'T');

        $objects = [$templateObjectType];
        $argumentType = $scope->getType($args[0]->value);
        $objects[] = $argumentType->getClassStringObjectType();

        return new Type\Generic\GenericObjectType(
            Prophecy\ObjectProphecy::class,
            [
                Type\TypeCombinator::intersect(...$objects),
            ],
        );
    }
}
