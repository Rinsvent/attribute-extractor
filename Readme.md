[![pipeline status](https://git.rinsvent.ru/rinsvent/attribute-extractor/badges/master/pipeline.svg)](https://git.rinsvent.ru/rinsvent/attribute-extractor/-/commits/master)
[![coverage report](https://git.rinsvent.ru/rinsvent/attribute-extractor/badges/master/coverage.svg)](https://git.rinsvent.ru/rinsvent/attribute-extractor/-/commits/master)

PHP 8 attribute extractor
===

## Установка
```bash
composer require rinsvent/attribute-extractor
```

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
use Rinsvent\AttributeExtractor\ClassIterator;

// Инициалищируем
$classIterator = new ClassIterator(HelloRequest::class, RequestDTO::class);
// Получаем первый атрибут
$result = $classIterator[0];
```

## Получаем атрибуты свойства класса
```php
use Rinsvent\AttributeExtractor\PropertyIterator;

// Инициалищируем
$propertyIterator = new PropertyIterator(HelloRequest::class, 'dto', PropertyPath::class);
// Получаем первый атрибут
$result = $propertyIterator[0];
```
## Получаем атрибуты метода класса
```php
use Rinsvent\AttributeExtractor\MethodIterator;

// Инициалищируем
$methodIterator = new MethodIterator(HelloRequest::class, 'getDto', MultiplePropertyPath::class);
// Перебираем все атрибуты
foreach ($methodIterator as $result) {
    // todo реализация 
}
```

## Реализована поддержка получение атрибутов наследников
```php
#[\Attribute]
class RequestDTO
{
    public function __construct(
        public string $className,
        public string $jsonPath = '$',
    ) {}
}

#[\Attribute]
class UserRequestDTO extends RequestDTO
{
    public function __construct(
        public string $className,
        public string $jsonPath = '$.user',
    ) {}
}
```

```php
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\UserRequestDTO;

class ExtendsRequest
{
    #[UserRequestDTO(className: 'HelloRequestDTO')]
    public object $user;
}
```

```php
$propertyIterator = new PropertyIterator(ExtendsRequest::class, 'user', RequestDTO::class);
$result = $propertyIterator[0];
```
