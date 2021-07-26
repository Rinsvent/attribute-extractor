<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation;

#[\Attribute]
class RequestDTO
{
    public function __construct(
        public string $className,
        public string $jsonPath = '$',
    ) {}
}
