<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation;

#[\Attribute]
class HeaderKey
{
    public function __construct(
        public string $key
    ) {}
}