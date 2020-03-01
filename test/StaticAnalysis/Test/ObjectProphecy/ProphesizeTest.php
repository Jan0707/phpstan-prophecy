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
use Prophecy\Argument;
use Prophecy\Prophecy;

/**
 * @internal
 *
 * @coversNothing
 */
final class ProphesizeTest extends Framework\TestCase
{
    private $prophecyWithoutDocBlock;

    /**
     * @var Prophecy\ObjectProphecy<Src\BaseModel>
     */
    private $prophecyWithDocBlock;

    protected function setUp(): void
    {
        $this->prophecyWithoutDocBlock = $this->prophesize(Src\BaseModel::class);
        $this->prophecyWithDocBlock = $this->prophesize(Src\BaseModel::class);
    }

    public function testCreateProphecyWithoutDocBlockInSetUp(): void
    {
        $this->prophecyWithoutDocBlock
            ->getFoo()
            ->willReturn('bar');

        $this->prophecyWithoutDocBlock
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $this->prophecyWithoutDocBlock->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyWithDocBlockInSetUp(): void
    {
        $this->prophecyWithDocBlock
            ->getFoo()
            ->willReturn('bar');

        $this->prophecyWithDocBlock
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $this->prophecyWithDocBlock->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyInTestMethod(): void
    {
        $prophecy = $this->prophesize(Src\BaseModel::class);

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndWithoutReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndWithoutReturnTypeDeclaration();

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyInHelperMethodWithoutDocBlockAndWithReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithoutDocBlockAndWithReturnTypeDeclaration();

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    public function testCreateProphecyInHelperMethodWithDocBlockAndReturnTypeDeclaration(): void
    {
        $prophecy = $this->createProphecyWithDocBlockAndReturnTypeDeclaration();

        $prophecy
            ->getFoo()
            ->willReturn('bar');

        $prophecy
            ->doubleTheNumber(Argument::is(2))
            ->willReturn(5);

        $testDouble = $prophecy->reveal();

        self::assertEquals('bar', $testDouble->getFoo());
        self::assertEquals(5, $testDouble->doubleTheNumber(2));
    }

    private function createProphecyWithoutDocBlockAndReturnTypeDeclaration()
    {
        return $this->prophesize(Src\BaseModel::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\BaseModel>
     */
    private function createProphecyWithDocBlockAndWithoutReturnTypeDeclaration()
    {
        return $this->prophesize(Src\BaseModel::class);
    }

    private function createProphecyWithoutDocBlockAndWithReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize(Src\BaseModel::class);
    }

    /**
     * @return Prophecy\ObjectProphecy<Src\BaseModel>
     */
    private function createProphecyWithDocBlockAndReturnTypeDeclaration(): Prophecy\ObjectProphecy
    {
        return $this->prophesize(Src\BaseModel::class);
    }
}
