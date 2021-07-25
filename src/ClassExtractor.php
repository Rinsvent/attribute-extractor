<?php

namespace Rinsvent\RequestBundle\Attribute;

use ReflectionClass;

class ClassExtractor
{
    public array $items = [];
    public bool $isInitialized = false;
    public ReflectionClass $reflectionClass;

    public function __construct(string $className)
    {
        $this->reflectionClass = new ReflectionClass($className);
    }

    public function fetch(string $className): ?object
    {
        if (!$this->isInitialized) {
            $this->items = $this->reflectionClass->getAttributes($className);
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
