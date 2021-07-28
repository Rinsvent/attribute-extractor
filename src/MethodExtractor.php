<?php

namespace Rinsvent\AttributeExtractor;

use ReflectionMethod;

class MethodExtractor
{
    public array $items = [];
    public ReflectionMethod $reflectionMethod;

    public function __construct(string $className, string $method)
    {
        $this->reflectionMethod = new ReflectionMethod($className, $method);
    }

    public function fetch(string $className): ?object
    {
        $pathHash = $this->getPathHash($className);
        if (!isset($this->items[$pathHash])) {
            $this->items[$pathHash] = $this->reflectionMethod->getAttributes($className);
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
