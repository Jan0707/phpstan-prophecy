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

namespace JanGregor\Prophecy\Test\StaticAnalysis;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @internal
 *
 * @coversNothing
 */
final class BaseModelTest extends TestCase
{
    /**
     * @var BaseModel|ObjectProphecy
     */
    private $subject;

    public function testBasicProperty(): void
    {
        $word = 'bar';

        $subject = new BaseModel();
        $subject->setFoo($word);

        self::assertEquals($word, $subject->getFoo());
        self::assertEquals(4, $subject->doubleTheNumber(2));
    }

    public function testWithProphecy(): void
    {
        $subject = $this->prophesize(BaseModel::class);
        $subject->getFoo()->willReturn('bar');

        $subject->doubleTheNumber(Argument::is(2))->willReturn(5);

        self::assertEquals('bar', $subject->reveal()->getFoo());
        self::assertEquals(5, $subject->reveal()->doubleTheNumber(2));
    }

    /**
     * @before
     */
    public function createSubject(): void
    {
        $this->subject = $this->prophesize(BaseModel::class);
    }

    public function testProphesizedAttributesShouldAlsoWork(): void
    {
        $this->subject->getFoo()->willReturn('bar');
        $this->subject->doubleTheNumber(Argument::is(2))->willReturn(5);

        $subject = $this->subject->reveal();

        self::assertEquals('bar', $subject->getFoo());
        self::assertEquals(5, $subject->doubleTheNumber(2));
    }

    public function testWillExtendWorks(): void
    {
        $baz = $this->prophesize()->willExtend(Baz::class);

        $baz
            ->baz()
            ->shouldBeCalled()
            ->willReturn('Hmm');

        $subject = new BaseModel();

        self::assertSame('Hmm', $subject->baz($baz->reveal()));
    }

    public function testWillImplementWorks(): void
    {
        $fooThatAlsoBars = $this->prophesize(Foo::class);

        $fooThatAlsoBars->willImplement(Bar::class);

        $fooThatAlsoBars
            ->bar()
            ->shouldBeCalled()
            ->willReturn('Oh');

        $subject = new BaseModel();

        self::assertSame('Oh', $subject->bar($fooThatAlsoBars->reveal()));
    }
}
