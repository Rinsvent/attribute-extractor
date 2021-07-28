<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionProperty;

class PropertyExtractor
{
    public array $items = [];
    public bool $isInitialized = false;
    public ReflectionProperty $reflectionProperty;

    public function __construct(string $className, string $property)
    {
        $this->reflectionProperty = new ReflectionProperty($className, $property);
    }

    public function fetch(string $className): ?object
    {
        $pathHash = $this->getPathHash($className);
        if (!isset($this->items[$pathHash])) {
            $this->items[$pathHash] = $this->reflectionProperty->getAttributes($className);
            $this->isInitialized = true;
        }

        $attribute = array_shift($this->items[$pathHash]);
        if ($attribute) {
            return $attribute->newInstance();
        }

        unset($this->items[$pathHash]);
        return null;
    }

    public function reinit(): void
    {
        $this->isInitialized = false;
        $this->items = [];
    }

    private function getPathHash(string $className): string
    {
        return md5($className);
    }
}
