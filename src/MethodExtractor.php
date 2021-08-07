<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionMethod;

class MethodExtractor  extends AbstractExtractor
{
    public function __construct(string $className, string $method)
    {
        $this->reflectionObject = new ReflectionMethod($className, $method);
    }
}
