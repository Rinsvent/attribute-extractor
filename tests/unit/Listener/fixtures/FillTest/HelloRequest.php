<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest;

use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation\PropertyPath;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation\RequestDTO;

#[RequestDTO(className: 'HelloRequestDTO', jsonPath: '$.customObject')]
class HelloRequest
{
    #[HeaderKey(key: 'X-Surname')]
    public string $surname;
    public int $age;
    #[PropertyPath(path: 'DTO')]
    public string $dto;
}
