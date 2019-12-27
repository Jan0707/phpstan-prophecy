<?php

namespace Tests\Test;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Model\BaseModel;

/**
 * @internal
 *
 * @covers \Tests\Model\BaseModel
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
}
