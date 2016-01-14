<?php
namespace enzyme\representer\Test;

use enzyme\representer\test\data\Example1;
use enzyme\representer\test\data\Example1Representer;

class ClassRepresenterTest extends \PHPUnit_Framework_TestCase
{
    public $target;

    public function setUp()
    {
        $this->target = new Example1();
    }

    public function tearDown()
    {
        unset($this->target);
    }

    public function testProjection()
    {
        $projection = Example1Representer::one($this->target);

        $this->assertNotEmpty($projection);

        $this->assertEquals($projection['titleAs'], $this->target->title);
        $this->assertEquals($projection['status'], $this->target->status);
        $this->assertEquals($projection['pubDate'], $this->target->pubDate->format('Y-m-d'));
    }

    public function testRestore()
    {
        $projection = Example1Representer::one($this->target);

        $post = Example1Representer::restore($projection, Example1::class);

        $this->assertInstanceOf(Example1::class, $post);

        $this->assertEquals($post->title, $this->target->title);
        $this->assertEquals($post->status, $this->target->status);
        $this->assertEquals($post->pubDate, $this->target->pubDate);
    }
}
