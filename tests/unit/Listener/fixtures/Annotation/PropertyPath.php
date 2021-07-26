<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation;

#[\Attribute]
class PropertyPath
{
    public function __construct(
        public string $path
    ) {}
}