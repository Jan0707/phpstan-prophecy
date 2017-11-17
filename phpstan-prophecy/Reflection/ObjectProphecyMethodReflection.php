<?php

namespace JanGregor\Prophecy\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use Prophecy\Prophecy\MethodProphecy;

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

    /**
     * @return ParameterReflection[]
     */
    public function getParameters(): array
    {
        return []; // todo
    }

    public function isVariadic(): bool
    {
        return true; // todo?
    }

    public function getReturnType(): Type
    {
        return new ObjectType(MethodProphecy::class);
    }

    public function getPrototype(): self
    {
        // TODO: Implement getPrototype() method.
    }
}
