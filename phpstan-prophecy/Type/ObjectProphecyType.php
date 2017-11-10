<?php

namespace JanGregor\Prophecy\Type;

use PHPStan\Type\ObjectType;
use Prophecy\Prophecy\ObjectProphecy;

class ObjectProphecyType extends ObjectType
{
    /**
     * @var string
     */
    protected $prophesizedClass;

    /**
     * ObjectProphecyType constructor.
     *
     * @param string $prophesizedClass The class that is being mocked/prophesized
     */
    public function __construct(string $prophesizedClass)
    {
        $this->prophesizedClass = $prophesizedClass;

        parent::__construct(ObjectProphecy::class);

        var_dump($this);
    }
}