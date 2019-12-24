<?php

namespace Tests\UnitTesting;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
	public function testEquals()
    {
        $this->assertEquals(1, 1);
    }
    public function testSuccess()
    {
        $this->assertEquals('bar', 'bar');
    }
}