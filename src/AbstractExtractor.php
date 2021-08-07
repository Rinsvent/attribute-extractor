<?php

namespace Rinsvent\AttributeExtractor;

class AbstractExtractor
{
    public array $items = [];
    public object $reflectionObject;

    public function fetch(string $className): ?object
    {
        $pathHash = $this->getPathHash($className);
        if (!isset($this->items[$pathHash])) {
            $items = $this->reflectionObject->getAttributes();
            $items = array_filter($items, function (\ReflectionAttribute $attribute, $key) use ($className) {
                return $attribute->newInstance() instanceof $className;
            }, ARRAY_FILTER_USE_BOTH);
            $this->items[$pathHash] = $items;
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
