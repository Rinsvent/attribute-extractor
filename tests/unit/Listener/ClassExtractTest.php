<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\ClassIterator;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\RequestDTO;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\HelloRequest;

class ClassExtractTest extends \Codeception\Test\Unit
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
        $classExtractor = new ClassIterator(HelloRequest::class, HeaderKey::class);
        $result = $classExtractor[0];
        $this->assertNull($result);
    }

    public function testExtractExistClassAttribute()
    {
        $classExtractor = new ClassIterator(HelloRequest::class, RequestDTO::class);
        $result = $classExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('HelloRequestDTO', $result->className);
        $this->assertEquals('$.customObject', $result->jsonPath);
        $this->assertEquals(1, count($classExtractor));
    }
}
