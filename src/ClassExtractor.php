<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionClass;

class ClassExtractor extends AbstractExtractor
{
    public function __construct(string $className)
    {
        $this->reflectionObject = new ReflectionClass($className);
    }
}
