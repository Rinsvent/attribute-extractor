<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\MethodExtractor;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\HeaderKey;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\MultiplePropertyPath;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\PropertyPath;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\HelloRequest;

class ClassMethodExtractTest extends \Codeception\Test\Unit
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
        $methodExtractor = new MethodExtractor(HelloRequest::class, 'getAge');
        $result = $methodExtractor->fetch(HeaderKey::class);
        $this->assertNull($result);
    }

    public function testExtractExistMethodAttribute()
    {
        $methodExtractor = new MethodExtractor(HelloRequest::class, 'getAge');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('age3', $result->path);
    }

    public function testDoubleExtractExistClassAttribute()
    {
        $methodExtractor = new MethodExtractor(HelloRequest::class, 'getAge');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('age3', $result->path);
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNull($result);
    }

    public function testReinitExtractExistClassAttribute()
    {
        $methodExtractor = new MethodExtractor(HelloRequest::class, 'getAge');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('age3', $result->path);
        $methodExtractor->reinit();
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('age3', $result->path);
    }

    public function testExtractExistMultipleMethodAttribute()
    {
        $methodExtractor = new MethodExtractor(HelloRequest::class, 'getDto');
        $result = $methodExtractor->fetch(MultiplePropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('dto1', $result->path);
        $result = $methodExtractor->fetch(MultiplePropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('dto2', $result->path);
        $result = $methodExtractor->fetch(MultiplePropertyPath::class);
        $this->assertNull($result);
    }
}
