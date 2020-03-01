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
final class WillExtendTest extends Framework\TestCase
{
    private $prophecyWithoutDocBlock;

    /**
     * @var Prophecy\ObjectProphecy<Src\Baz>
     */
    private $prophecyWithDocBlock;

    protected function setUp(): void
    {
        $this->prophecyWithoutDocBlock = $this->prophesize()->willExtend(Src\Baz::class);
        $this->prophecyWithDocBlock = $this->prophesize()->willExtend(Src\Baz::class);
    }

    public function testCreateProphecyWithoutDocBlockInSetUp(): void
    {
        $this->prophecyWithoutDocBlock
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($this->prophecyWithoutDocBlock->reveal()));
    }

    public function testCreateProphecyWithDocBlockInSetUp(): void
    {
        $this->prophecyWithDocBlock
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($this->prophecyWithDocBlock->reveal()));
    }

    public function testCreateProphecyInTestMethod(): void
    {
        $prophecy = $this->prophesize()->willExtend(Src\Baz::class);

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndWithoutReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndWithoutReturnTypeDeclaration();

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndWithReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndWithReturnTypeDeclaration();

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    private function createProphecyWithoutDocBlockAndReturnTypeDeclaration()
    {
        return $this->prophesize()->willExtend(Src\Baz::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\Baz>
     */
    private function createProphecyWithDocBlockAndWithoutReturnTypeDeclaration()
    {
        return $this->prophesize()->willExtend(Src\Baz::class);
    }

    private function createProphecyWithoutDocBlockAndWithReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize()->willExtend(Src\Baz::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\Baz>
     */
    private function createProphecyWithDocBlockAndReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize()->willExtend(Src\Baz::class);
    }
}
