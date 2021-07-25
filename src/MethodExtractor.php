<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionMethod;

class MethodExtractor
{
    public array $items = [];
    public bool $isInitialized = false;
    public ReflectionMethod $reflectionMethod;

    public function __construct(string $className, string $method)
    {
        $this->reflectionMethod = new ReflectionMethod($className, $method);
    }

    public function fetch(string $className): ?object
    {
        if (!$this->isInitialized) {
            $this->items = $this->reflectionMethod->getAttributes($className);
            $this->isInitialized = true;
        }

        $attribute = array_shift($this->items);
        if ($attribute) {
            return $attribute->newInstance();
        }

        return null;
    }

    public function reset()
    {
        $this->isInitialized = false;
        $this->items = [];
    }
}
