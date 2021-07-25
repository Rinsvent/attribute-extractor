<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation;

#[\Attribute]
class PropertyPath
{
    public function __construct(
        public string $path
    ) {}
}