<?php

namespace Rinsvent\AttributeExtractor\Tests\Listener;

use Rinsvent\AttributeExtractor\PropertyExtractor;
use Rinsvent\AttributeExtractor\Tests\unit\Listener\fixtures\Annotation\HeaderKey;
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
        $methodExtractor = new PropertyExtractor(HelloRequest::class, 'age');
        $result = $methodExtractor->fetch(HeaderKey::class);
        $this->assertNull($result);
    }

    public function testExtractExistMethodAttribute()
    {
        $methodExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
    }

    public function testDoubleExtractExistClassAttribute()
    {
        $methodExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNull($result);
    }

    public function testReinitExtractExistClassAttribute()
    {
        $methodExtractor = new PropertyExtractor(HelloRequest::class, 'dto');
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
        $methodExtractor->reinit();
        $result = $methodExtractor->fetch(PropertyPath::class);
        $this->assertNotNull($result);
        $this->assertEquals('DTO', $result->path);
    }
}
