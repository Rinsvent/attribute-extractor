<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures;

use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\UserRequestDTO;

class ExtendsRequest
{
    #[UserRequestDTO(className: 'HelloRequestDTO')]
    public object $user;
}
