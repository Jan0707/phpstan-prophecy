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

namespace JanGregor\Prophecy\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;

class ProphecyMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        // don't know which class is prophesized here, so let's say yes to every method
        // must match class in MockBuilderType parent::__construct() equivalent
        return 'Prophecy\Prophecy\ObjectProphecy' === $classReflection->getName();
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        return new ObjectProphecyMethodReflection($classReflection, $methodName);
    }
}
