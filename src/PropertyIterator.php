<?php

declare(strict_types=1);

namespace Rinsvent\AttributeExtractor;

use ReflectionProperty;

class PropertyIterator extends AttributeIterator
{
    public function __construct(
        string $classname,
        string $property,
        string $attribute,
    ) {
        parent::__construct(new ReflectionProperty($classname, $property), $attribute);
    }
}
