<?php

declare(strict_types=1);

namespace Rinsvent\AttributeExtractor;

use RuntimeException;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

abstract class AttributeIterator implements \Iterator, \ArrayAccess, \Countable
{
    private int $position = 0;
    private array $data = [];

    public function __construct(
        ReflectionClass|ReflectionProperty|ReflectionMethod $ro,
        string $attribute,
    ) {
        $items = $ro->getAttributes($attribute, ReflectionAttribute::IS_INSTANCEOF);
        $this->data = array_map(static fn (ReflectionAttribute $attribute) => $attribute->newInstance(), $items);
    }

    public function current(): mixed
    {
        return $this->data[$this->position]->newInstance();
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new RuntimeException('offsetSet not allowed');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new RuntimeException('offsetUnset not allowed');
    }

     public function count()
     {
         return count($this->data);
     }
 }
