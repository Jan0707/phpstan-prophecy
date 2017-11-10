<?php

namespace App\Test\Model;

use App\Model\BaseModel;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class BaseModelTest extends TestCase
{
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
}