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

namespace JanGregor\Prophecy\Test\StaticAnalysis\Test\ObjectProphecy;

use JanGregor\Prophecy\Test\StaticAnalysis\Src;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @coversNothing
 */
final class WillImplementTest extends Framework\TestCase
{
    private $prophecy;

    protected function setUp(): void
    {
        $this->prophecy = $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }

    public function testCreateProphecyInSetUp(): void
    {
        $this->prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecy->reveal()));
    }

    public function testCreateProphecyInTestMethod(): void
    {
        $prophecy = $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethod(): void
    {
        $prophecy = $this->createProphecy();

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    private function createProphecy()
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }
}
