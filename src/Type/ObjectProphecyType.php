<?php

namespace JanGregor\Prophecy\Type;

use PHPStan\Type\ObjectType;
use PHPStan\Type\VerbosityLevel;
use Prophecy\Prophecy\ObjectProphecy;

class ObjectProphecyType extends ObjectType
{
    /**
     * @var string
     */
    protected $prophesizedClass;

    /**
     * @param string $prophesizedClass The class that is being mocked/prophesized
     */
    public function __construct(string $prophesizedClass)
    {
        $this->prophesizedClass = $prophesizedClass;

        parent::__construct(ObjectProphecy::class);
    }

    public function describe(VerbosityLevel $level): string
    {
        return sprintf('%s<%s>', parent::describe($level), $this->prophesizedClass);
    }

    public function getProphesizedClass(): string
    {
        return $this->prophesizedClass;
    }
}
