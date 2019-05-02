<?php

namespace JanGregor\Prophecy\Type;

use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\VerbosityLevel;

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

        parent::__construct('Prophecy\Prophecy\ObjectProphecy');
    }

    public function describe(VerbosityLevel $level): string
    {
        return sprintf('%s<%s>', parent::describe($level), $this->prophesizedClass);
    }

    public function getProphesizedClass(): string
    {
        return $this->prophesizedClass;
    }

    /**
     * @param mixed[] $properties
     * @return self
     */
    public static function __set_state(array $properties): Type
    {
        return new self($properties['prophesizedClass']);
    }
}
