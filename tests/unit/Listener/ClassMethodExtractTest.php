<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\MethodIterator;
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
        $methodExtractor = new MethodIterator(HelloRequest::class, 'getAge', HeaderKey::class);
        $result = $methodExtractor[0];
        $this->assertNull($result);
    }

    public function testExtractExistMethodAttribute()
    {
        $methodExtractor = new MethodIterator(HelloRequest::class, 'getAge', PropertyPath::class);
        $result = $methodExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('age3', $result->path);
    }

    public function testExtractExistMultipleMethodAttribute()
    {
        $methodExtractor = new MethodIterator(HelloRequest::class, 'getDto', MultiplePropertyPath::class);
        $result = $methodExtractor[0];
        $this->assertNotNull($result);
        $this->assertEquals('dto1', $result->path);
        $result = $methodExtractor[1];
        $this->assertNotNull($result);
        $this->assertEquals('dto2', $result->path);
        $result = $methodExtractor[2];
        $this->assertNull($result);
    }
}
