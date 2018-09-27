<?php

namespace JanGregor\Prophecy\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\TrivialParametersAcceptor;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

class ObjectProphecyMethodReflection implements MethodReflection
{
    /**
     * @var ClassReflection
     */
    private $declaringClass;

    /**
     * @var string
     */
    private $name;

    public function __construct(ClassReflection $declaringClass, string $name)
    {
        $this->declaringClass = $declaringClass;
        $this->name = $name;
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClass;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVariants(): array
    {
        return [
            new TrivialParametersAcceptor(),
        ];
    }

    /**
     * @return ParameterReflection[]
     */
    public function getParameters(): array
    {
        return [];
    }

    public function isVariadic(): bool
    {
        return true;
    }

    public function getReturnType(): Type
    {
        return new ObjectType('Prophecy\Prophecy\MethodProphecy');
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }
}
