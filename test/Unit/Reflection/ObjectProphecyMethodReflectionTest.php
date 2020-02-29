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

namespace JanGregor\Prophecy\Test\Unit\Reflection;

use JanGregor\Prophecy\Reflection\ObjectProphecyMethodReflection;
use PHPStan\Reflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type;
use PHPUnit\Framework;
use Prophecy\Prophecy;

/**
 * @covers \JanGregor\Prophecy\Reflection\ObjectProphecyMethodReflection
 *
 * @internal
 */
final class ObjectProphecyMethodReflectionTest extends Framework\TestCase
{
    public function testConstructorSetsValues(): void
    {
        $classReflection = $this->prophesize(Reflection\ClassReflection::class);
        $name = 'hmm';

        $reflection = new ObjectProphecyMethodReflection(
            $classReflection->reveal(),
            $name
        );

        self::assertSame($classReflection->reveal(), $reflection->getDeclaringClass());
        self::assertSame($name, $reflection->getName());
    }

    public function testDefaults(): void
    {
        $reflection = new ObjectProphecyMethodReflection(
            $this->prophesize(Reflection\ClassReflection::class)->reveal(),
            'hmm'
        );

        self::assertNull($reflection->getDeprecatedDescription());
        self::assertNull($reflection->getDocComment());
        self::assertSame($reflection, $reflection->getPrototype());
        self::assertNull($reflection->getThrowType());

        $variants = [
            new Reflection\FunctionVariant(
                Type\Generic\TemplateTypeMap::createEmpty(),
                null,
                [],
                true,
                new Type\ObjectType(Prophecy\MethodProphecy::class)
            ),
        ];

        self::assertEquals($variants, $reflection->getVariants());
        self::assertTrue($reflection->hasSideEffects()->equals(TrinaryLogic::createMaybe()));
        self::assertTrue($reflection->isDeprecated()->equals(TrinaryLogic::createNo()));
        self::assertTrue($reflection->isInternal()->equals(TrinaryLogic::createNo()));
        self::assertFalse($reflection->isPrivate());
        self::assertTrue($reflection->isPublic());
        self::assertFalse($reflection->isStatic());
    }
}
