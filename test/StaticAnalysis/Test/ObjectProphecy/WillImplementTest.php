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
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @internal
 *
 * @coversNothing
 */
final class WillImplementTest extends Framework\TestCase
{
    use ProphecyTrait;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy<Src\Bar&Src\Foo>
     */
    private \Prophecy\Prophecy\ObjectProphecy $prophecy;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy<Src\Foo>
     */
    private \Prophecy\Prophecy\ObjectProphecy $prophecyFoo;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy<Src\Bar>
     */
    private \Prophecy\Prophecy\ObjectProphecy $prophecyBar;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy<Src\Bar>
     */
    private \Prophecy\Prophecy\ObjectProphecy $prophecyOnlyInterface;

    protected function setUp(): void
    {
        $this->prophecy = $this->prophesize(Src\Foo::class)
            ->willImplement(Src\Bar::class);
        $this->prophecyFoo = $this->prophesize(Src\Foo::class)
            ->willImplement(Src\Bar::class);
        $this->prophecyBar = $this->prophesize(Src\Foo::class)
            ->willImplement(Src\Bar::class);
        $this->prophecyOnlyInterface = $this->prophesize()
            ->willImplement(Src\Bar::class);
    }

    public function testCreateProphecyInSetUp(): void
    {
        $this->prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $this->prophecy
            ->foo()
            ->shouldBeCalled()
            ->willReturn('Oh2');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecy->reveal()));
        self::assertSame('Oh2', $subject->foo($this->prophecy->reveal()));
    }

    public function testCreateProphecyFooInSetUp(): void
    {
        $this->prophecyFoo
            ->foo()
            ->shouldBeCalled()
            ->willReturn('Oh2');

        $subject = new Src\BaseModel();

        self::assertSame('Oh2', $subject->foo($this->prophecyFoo->reveal()));
    }

    public function testCreateProphecyBarInSetUp(): void
    {
        $this->prophecyBar
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecyBar->reveal()));
    }

    public function testCreateProphecyOnlyInterfaceInSetUp(): void
    {
        $this->prophecyOnlyInterface
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecyOnlyInterface->reveal()));
    }

    public function testCreateProphecyInTestMethod(): void
    {
        $prophecy = $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);

        $prophecy
            ->foo()
            ->shouldBeCalled()
            ->willReturn('foo');

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        $fooBar = $prophecy->reveal();
        self::assertSame('foo', $fooBar->foo());
        self::assertSame('Oh', $subject->bar($fooBar));
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

    /**
     * @return \Prophecy\Prophecy\ObjectProphecy<Src\Bar&Src\Foo>
     */
    private function createProphecy()
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }
}
