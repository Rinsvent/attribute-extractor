<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionClass;

class ClassExtractor
{
    public array $items = [];
    public ReflectionClass $reflectionClass;

    public function __construct(string $className)
    {
        $this->reflectionClass = new ReflectionClass($className);
    }

    public function fetch(string $className): ?object
    {
        $pathHash = $this->getPathHash($className);
        if (!isset($this->items[$pathHash])) {
            $this->items[$pathHash] = $this->reflectionClass->getAttributes($className);
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
        $this->items = [];
    }

    private function getPathHash(string $className): string
    {
        return md5($className);
    }
}
