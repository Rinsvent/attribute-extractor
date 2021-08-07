<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionProperty;

class PropertyExtractor extends AbstractExtractor
{
    public function __construct(string $className, string $property)
    {
        $this->reflectionObject = new ReflectionProperty($className, $property);
    }
}
