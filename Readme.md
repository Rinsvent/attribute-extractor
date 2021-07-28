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
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\MultiplePropertyPath;

#[RequestDTO(className: 'HelloRequestDTO', jsonPath: '$.customObject')]
class HelloRequest
{
    #[HeaderKey(key: 'X-Surname')]
    public string $surname;
    public int $age;
    #[PropertyPath(path: 'DTO')]
    public string $dto;
    
    #[MultiplePropertyPath(path: 'dto1')]
    #[MultiplePropertyPath(path: 'dto2')]
    public function getDto(): string
    {
        return $this->dto;
    }
}
```

## Получаем атрибуты класса
```php
// Инициалищируем
$classExtractor = new ClassExtractor(HelloRequest::class);
// Получаем первый атрибут
$result = $classExtractor->fetch(RequestDTO::class);
```

## Получаем атрибуты свойства класса
```php
// Инициалищируем
$propertyExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
// Получаем первый атрибут
$result = $propertyExtractor->fetch(PropertyPath::class);
```
## Получаем атрибуты метода класса
```php
// Инициалищируем
$methodExtractor = new MethodExtractor(HelloRequest::class, 'getDto');
// Перебираем все атрибуты
while ($result = $methodExtractor->fetch(MultiplePropertyPath::class)) {
    // todo реализация 
}
```
