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

namespace JanGregor\Prophecy\Test\StaticAnalysis\Test\ObjectProphecy;

use JanGregor\Prophecy\Test\StaticAnalysis\Src;
use PHPUnit\Framework;
use Prophecy\Prophecy;

/**
 * @internal
 *
 * @coversNothing
 */
final class WillImplementTest extends Framework\TestCase
{
    private $prophecyWithoutDocBlock;

    /**
     * @var Prophecy\ObjectProphecy<Src\Foo&Src\Bar>
     */
    private $prophecyWithDocBlock;

    protected function setUp(): void
    {
        $this->prophecyWithoutDocBlock = $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
        $this->prophecyWithDocBlock = $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }

    public function testCreateProphecyWithoutDocBlockInSetUp(): void
    {
        $this->prophecyWithoutDocBlock
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecyWithoutDocBlock->reveal()));
    }

    public function testCreateProphecyWithDocBlockInSetUp(): void
    {
        $this->prophecyWithoutDocBlock
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($this->prophecyWithoutDocBlock->reveal()));
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

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndWithoutReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndWithoutReturnTypeDeclaration();

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndWithReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndWithReturnTypeDeclaration();

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new Src\BaseModel();

        self::assertSame('Oh', $subject->bar($prophecy->reveal()));
    }

    private function createProphecyWithoutDocBlockAndReturnTypeDeclaration()
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\Foo&Src\Bar>
     */
    private function createProphecyWithDocBlockAndWithoutReturnTypeDeclaration()
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }

    private function createProphecyWithoutDocBlockAndWithReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\Foo&Src\Bar>
     */
    private function createProphecyWithDocBlockAndReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize(Src\Foo::class)->willImplement(Src\Bar::class);
    }
}
