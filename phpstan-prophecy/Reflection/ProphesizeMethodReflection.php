<?php

namespace JanGregor\Prophecy\Reflection;

use JanGregor\Prophecy\Type\ObjectProphecyType;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Type;

class ProphesizeMethodReflection implements MethodReflection
{
    public function getDeclaringClass(): ClassReflection
    {
        return new ClassReflection();
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        false;
    }

    public function isPublic(): bool
    {
        true;
    }

    public function getPrototype(): self
    {
        return self;
    }

    public function getName(): string
    {
        return self::class;
    }

    /**
     * @return \PHPStan\Reflection\ParameterReflection[]
     */
    public function getParameters(): array
    {
        return [];
    }

    public function isVariadic(): bool
    {
        return false;
    }

    public function getReturnType(): Type
    {
        return new ObjectProphecyType();
    }
}