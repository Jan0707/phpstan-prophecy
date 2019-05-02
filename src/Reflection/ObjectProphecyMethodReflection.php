<?php

namespace JanGregor\Prophecy\Reflection;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Type\ObjectType;
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

    public function getVariants(): array
    {
        return [
            new FunctionVariant(
                [],
                true,
                new ObjectType(MethodProphecy::class)
            ),
        ];
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }
}
