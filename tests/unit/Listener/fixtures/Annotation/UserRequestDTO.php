<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation;

#[\Attribute]
class UserRequestDTO extends RequestDTO
{
    public function __construct(
        public string $className,
        public string $jsonPath = '$.user',
    ) {}
}
