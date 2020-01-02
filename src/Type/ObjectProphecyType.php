<?php

declare(strict_types=1);

namespace JanGregor\Prophecy\Type;

use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\VerbosityLevel;

class ObjectProphecyType extends ObjectType
{
    /**
     * @var string[]
     */
    protected $prophesizedClasses;

    public function __construct(string ...$prophesizedClasses)
    {
        $this->prophesizedClasses = $prophesizedClasses;

        parent::__construct('Prophecy\Prophecy\ObjectProphecy');
    }

    public static function __set_state(array $properties): Type
    {
        return new self($properties['prophesizedClasses']);
    }

    public function describe(VerbosityLevel $level): string
    {
        return \sprintf(
            '%s<%s>',
            parent::describe($level),
            \implode(
                '&',
                $this->prophesizedClasses
            )
        );
    }

    public function addProphesizedClass(string $prophesizedClass): void
    {
        $this->prophesizedClasses[] = $prophesizedClass;
    }

    /**
     * @return string[]
     */
    public function getProphesizedClasses(): array
    {
        return $this->prophesizedClasses;
    }
}
