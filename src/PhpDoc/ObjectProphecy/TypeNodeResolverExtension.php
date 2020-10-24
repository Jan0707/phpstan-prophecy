<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018 Jan Gregor Emge-Triebel
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/Jan0707/phpstan-prophecy
 */

namespace JanGregor\Prophecy\PhpDoc\ObjectProphecy;

use PHPStan\Analyser;
use PHPStan\PhpDoc;
use PHPStan\PhpDocParser;
use PHPStan\Type;
use Prophecy\Prophecy;

/**
 * @internal
 */
final class TypeNodeResolverExtension implements PhpDoc\TypeNodeResolverAwareExtension, PhpDoc\TypeNodeResolverExtension
{
    /**
     * @var PhpDoc\TypeNodeResolver
     */
    private $typeNodeResolver;

    public function setTypeNodeResolver(PhpDoc\TypeNodeResolver $typeNodeResolver): void
    {
        $this->typeNodeResolver = $typeNodeResolver;
    }

    public function getCacheKey(): string
    {
        return 'prophecy-with-generics-v1';
    }

    public function resolve(PhpDocParser\Ast\Type\TypeNode $typeNode, Analyser\NameScope $nameScope): ?Type\Type
    {
        if (!$typeNode instanceof PhpDocParser\Ast\Type\UnionTypeNode) {
            return null;
        }

        if (2 === \count($typeNode->types)) {
            $objectProphecyType = null;
            $prophesizedType = null;

            foreach ($typeNode->types as $innerType) {
                $type = $this->typeNodeResolver->resolve($innerType, $nameScope);

                if ($type instanceof Type\TypeWithClassName) {
                    if (Prophecy\ObjectProphecy::class === $type->getClassName()) {
                        $objectProphecyType = $type;
                    } else {
                        $prophesizedType = $type;
                    }
                } else {
                    break;
                }
            }

            if (null !== $objectProphecyType && null !== $prophesizedType) {
                return new Type\Generic\GenericObjectType(
                    Prophecy\ObjectProphecy::class,
                    [
                        $prophesizedType,
                    ]
                );
            }
        }

        return null;
    }
}
