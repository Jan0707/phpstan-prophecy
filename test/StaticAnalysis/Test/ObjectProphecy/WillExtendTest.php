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

/**
 * @internal
 *
 * @coversNothing
 */
final class WillExtendTest extends Framework\TestCase
{
    private $prophecy;

    protected function setUp(): void
    {
        $this->prophecy = $this->prophesize()->willExtend(Src\Baz::class);
    }

    public function testCreateProphecyInSetUp(): void
    {
        $this->prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($this->prophecy->reveal()));
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

    public function testCreateProphecyInHelperMethod(): void
    {
        $prophecy = $this->createProphecy();

        $prophecy
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new Src\BaseModel();

        self::assertSame('Hmm', $subject->baz($prophecy->reveal()));
    }

    private function createProphecy()
    {
        return $this->prophesize()->willExtend(Src\Baz::class);
    }
}
