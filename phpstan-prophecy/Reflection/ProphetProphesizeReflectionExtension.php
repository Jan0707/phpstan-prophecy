<?php

namespace JanGregor\Prophecy\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use Prophecy\Prophet;

class ProphetProphesizeReflectionExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        return $classReflection->getName() == Prophet::class && $methodName == 'prophesize';
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $methodReflection = new ProphesizeMethodReflection();

        return $methodReflection;
    }
}