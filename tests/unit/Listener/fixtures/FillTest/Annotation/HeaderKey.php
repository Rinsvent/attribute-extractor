<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation;

#[\Attribute]
class HeaderKey
{
    public function __construct(
        public string $key
    ) {}
}