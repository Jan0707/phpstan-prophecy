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

namespace JanGregor\Prophecy\Type;

use PHPStan\Type;

final class ObjectProphecyType extends Type\ObjectType
{
    /**
     * @var string[]
     */
    private $prophesizedClasses;

    public function __construct(string ...$prophesizedClasses)
    {
        $this->prophesizedClasses = $prophesizedClasses;

        parent::__construct('Prophecy\Prophecy\ObjectProphecy');
    }

    public static function __set_state(array $properties): Type\Type
    {
        return new self($properties['prophesizedClasses']);
    }

    public function describe(Type\VerbosityLevel $level): string
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
