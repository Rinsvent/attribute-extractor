<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation;

#[\Attribute(\Attribute::TARGET_ALL|\Attribute::IS_REPEATABLE)]
class MultiplePropertyPath
{
    public function __construct(
        public string $path
    ) {}
}