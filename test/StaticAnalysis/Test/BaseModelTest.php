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

namespace JanGregor\Prophecy\Test\StaticAnalysis\Test;

use JanGregor\Prophecy\Test\StaticAnalysis\Src;
use PHPUnit\Framework;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 *
 * @covers \JanGregor\Prophecy\Test\StaticAnalysis\Src\BaseModel
 */
final class BaseModelTest extends Framework\TestCase
{
    use ProphecyTrait;

    public function testDefaults(): void
    {
        $model = new Src\BaseModel();

        self::assertNull($model->getFoo());
    }

    public function testCanSetAndGetFoo(): void
    {
        $foo = 'Hello!';

        $model = new Src\BaseModel();

        $model->setFoo($foo);

        self::assertSame($foo, $model->getFoo());
    }

    public function testCanDoubleTheNumber(): void
    {
        $number = 9000;

        $model = new Src\BaseModel();

        self::assertSame(2 * $number, $model->doubleTheNumber($number));
    }

    public function testBarReturnsBar(): void
    {
        $value = 'Hmm';

        $bar = $this->prophesize(Src\Bar::class);

        $bar
            ->bar()
            ->willReturn($value);

        $model = new Src\BaseModel();

        self::assertSame($value, $model->bar($bar->reveal()));
    }

    public function testBazReturnsBaz(): void
    {
        $value = 'Ah!';

        $baz = $this->prophesize(Src\Baz::class);

        $baz
            ->baz()
            ->willReturn($value);

        $model = new Src\BaseModel();

        self::assertSame($value, $model->baz($baz->reveal()));
    }
}
