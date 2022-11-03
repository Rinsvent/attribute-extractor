<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\PropertyIterator;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\PropertyPath;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\RequestDTO;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\UserRequestDTO;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\ExtendsRequest;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\HelloRequest;

class ClassPropertyExtractTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testExtractEmptyMethodAttribute()
    {
        $propertyExtractor = new PropertyIterator(HelloRequest::class, 'age', HeaderKey::class);
        $result = $propertyExtractor[0];
        $this->assertNull($result);
    }

    public function testExtractExistMethodAttribute()
    {
        $propertyExtractor = new PropertyIterator(HelloRequest::class, 'dto', PropertyPath::class);
        $result = $propertyExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
    }

    public function testDoubleExtractExistClassAttribute()
    {
        $propertyExtractor = new PropertyIterator(HelloRequest::class, 'dto', PropertyPath::class);
        $result = $propertyExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
        $result = $propertyExtractor[1];
        $this->assertNull($result);
    }

    public function testCheckExtendsAttribute()
    {
        $propertyExtractor = new PropertyIterator(ExtendsRequest::class, 'user', RequestDTO::class);
        $result = $propertyExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('$.user', $result->jsonPath);
        $this->assertInstanceOf(UserRequestDTO::class, $result);
        $result = $propertyExtractor[1];
        $this->assertNull($result);
    }
}
