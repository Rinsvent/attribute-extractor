<?php

declare(strict_types=1);

namespace Rinsvent\AttributeExtractor;

use ReflectionClass;

class ClassIterator extends AttributeIterator
{
    public function __construct(
        string $classname,
        string $attribute,
    ) {
        parent::__construct(new ReflectionClass($classname), $attribute);
    }
}
