[![pipeline status](https://git.rinsvent.ru/rinsvent/attribute-extractor/badges/master/pipeline.svg)](https://git.rinsvent.ru/rinsvent/attribute-extractor/-/commits/master)
[![coverage report](https://git.rinsvent.ru/rinsvent/attribute-extractor/badges/master/coverage.svg)](https://git.rinsvent.ru/rinsvent/attribute-extractor/-/commits/master)

PHP 8 attribute extractor
===

## Пример класса с атрибутами
```php
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
}
```

## Получаем атрибуты класса
```php
// Инициалищируем
$classExtractor = new ClassExtractor(HelloRequest::class);
// Получаем первый атрибут
$result = $classExtractor->fetch(RequestDTO::class);
or
// Перебираем все атрибуты
while ($result = $classExtractor->fetch(RequestDTO::class)) {
    // todo реализация 
}
```

## Получаем атрибуты свойства класса
```php
// Инициалищируем
$methodExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
// Получаем первый атрибут
$result = $methodExtractor->fetch(PropertyPath::class);
```
