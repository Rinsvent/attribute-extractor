<?php

namespace Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures;

use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\PropertyPath;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\RequestDTO;

#[RequestDTO(className: 'HelloRequestDTO', jsonPath: '$.customObject')]
class HelloRequest
{
    #[HeaderKey(key: 'X-Surname')]
    public string $surname;
    public int $age;
    #[PropertyPath(path: 'DTO')]
    public string $dto;

    #[PropertyPath(path: 'age3')]
    public function getAge(): int
    {
        return $this->age;
    }

    #[PropertyPath(path: 'dto1')]
    public function getDto(): string
    {
        return $this->dto;
    }

}
