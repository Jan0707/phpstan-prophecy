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

namespace JanGregor\Prophecy\Reflection\ObjectProphecy;

use PHPStan\Reflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type;
use Prophecy\Prophecy;

/**
 * @internal
 */
final class MethodReflection implements Reflection\MethodReflection
{
    private $declaringClass;

    private $name;

    public function __construct(Reflection\ClassReflection $declaringClass, string $name)
    {
        $this->declaringClass = $declaringClass;
        $this->name = $name;
    }

    public function getDeclaringClass(): Reflection\ClassReflection
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
            new Reflection\FunctionVariant(
                Type\Generic\TemplateTypeMap::createEmpty(),
                null,
                [],
                true,
                new Type\ObjectType(Prophecy\MethodProphecy::class)
            ),
        ];
    }

    public function getPrototype(): Reflection\ClassMemberReflection
    {
        return $this;
    }

    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeprecatedDescription(): ?string
    {
        return null;
    }

    public function isFinal(): TrinaryLogic
    {
        return TrinaryLogic::createYes();
    }

    public function isInternal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getThrowType(): ?Type\Type
    {
        return null;
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return TrinaryLogic::createMaybe();
    }

    public function getDocComment(): ?string
    {
        return null;
    }
}
