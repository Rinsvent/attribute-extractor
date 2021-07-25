<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\ClassExtractor;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\Annotation\RequestDTO;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\FillTest\HelloRequest;

class ExtractTest extends \Codeception\Test\Unit
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
    public function testExtractEmptyClassAttribute()
    {
        $classExtractor = new ClassExtractor(HelloRequest::class);
        $result = $classExtractor->fetch(HeaderKey::class);
        $this->assertNull($result);
    }

    public function testExtractExistClassAttribute()
    {
        $classExtractor = new ClassExtractor(HelloRequest::class);
        $result = $classExtractor->fetch(RequestDTO::class);
        $this->assertNotNull($result);
        $this->assertEquals('HelloRequestDTO', $result->className);
        $this->assertEquals('$.customObject', $result->jsonPath);
    }

    public function testDoubleExtractExistClassAttribute()
    {
        $classExtractor = new ClassExtractor(HelloRequest::class);
        $result = $classExtractor->fetch(RequestDTO::class);
        $this->assertNotNull($result);
        $result = $classExtractor->fetch(RequestDTO::class);
        $this->assertNull($result);
    }
}
