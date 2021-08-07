<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\PropertyExtractor;
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
        $propertyExtractor = new PropertyExtractor(HelloRequest::class, 'age');
        $result = $propertyExtractor->fetch(HeaderKey::class);
        $this->assertNull($result);
    }

    public function testExtractExistMethodAttribute()
    {
        $propertyExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $propertyExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
    }

    public function testDoubleExtractExistClassAttribute()
    {
        $propertyExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $propertyExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
        $result = $propertyExtractor->fetch(PropertyPath::class);
        $this->assertNull($result);
    }

    public function testReinitExtractExistClassAttribute()
    {
        $propertyExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $propertyExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
        $propertyExtractor->reinit();
        $result = $propertyExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
    }

    public function testCheckExtendsAttribute()
    {
        $propertyExtractor = new PropertyExtractor(ExtendsRequest::class, 'user');
        $result = $propertyExtractor->fetch(RequestDTO::class);
        $this->assertNotNull($result);
        $this->assertEquals('$.user', $result->jsonPath);
        $this->assertInstanceOf(UserRequestDTO::class, $result);
        $result = $propertyExtractor->fetch(RequestDTO::class);
        $this->assertNull($result);
    }
}
