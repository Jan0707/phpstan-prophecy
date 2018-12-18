<?php

namespace Tests\Model;

class BaseModel
{
    /**
     * @var string
     */
    private $foo;

    /**
     * @return string
     */
    public function getFoo(): string
    {
        return $this->foo;
    }

    /**
     * @param string $foo
     */
    public function setFoo(string $foo)
    {
        $this->foo = $foo;
    }

    /**
     * @param int $number
     *
     * @return int
     */
    public function doubleTheNumber(int $number)
    {
        return 2 * $number;
    }
}
