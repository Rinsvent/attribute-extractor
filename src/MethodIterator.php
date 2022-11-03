<?php

declare(strict_types=1);

namespace Rinsvent\AttributeExtractor;

use ReflectionMethod;

class MethodIterator extends AttributeIterator
{
    public function __construct(
        string $classname,
        string $method,
        string $attribute,
    ) {
        parent::__construct(new ReflectionMethod($classname, $method), $attribute);
    }
}
