<?php

namespace Tests\Test;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Model\BaseModel;

class BaseModelTest extends TestCase
{
    /**
     * @var BaseModel|ObjectProphecy
     */
    private $subject;

    public function testBasicProperty()
    {
        $word = 'bar';

        $subject = new BaseModel();
        $subject->setFoo($word);

        $this->assertEquals($word, $subject->getFoo());
        $this->assertEquals(4, $subject->doubleTheNumber(2));
    }

    public function testWithProphecy()
    {
        $subject = $this->prophesize(BaseModel::class);
        $subject->getFoo()->willReturn('bar');

        $subject->doubleTheNumber(Argument::is(2))->willReturn(5);

        $this->assertEquals('bar', $subject->reveal()->getFoo());
        $this->assertEquals(5, $subject->reveal()->doubleTheNumber(2));
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

        $this->assertEquals('bar', $subject->getFoo());
        $this->assertEquals(5, $subject->doubleTheNumber(2));
    }
}
