<?php

namespace FineDiffTests\Parser\Operations;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Operations\Copy;

class CopyTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\Operations\OperationInterface::class, new Copy(10));
    }

    public function testGetFromLen()
    {
        $copy = new Copy(10);
        $this->assertEquals(10, $copy->getFromLen());
    }

    public function testGetToLen()
    {
        $copy = new Copy(342);
        $this->assertEquals(342, $copy->getToLen());
    }

    public function testGetOpcode()
    {
        $copy = new Copy(1);
        $this->assertEquals('c', $copy->getOpcode());

        $copy = new Copy(24);
        $this->assertEquals('c24', $copy->getOpcode());
    }

    public function testIncrease()
    {
        $copy = new Copy(25);

        $this->assertEquals(30, $copy->increase(5));
        $this->assertEquals(40, $copy->increase(10));
        $this->assertEquals(104, $copy->increase(64));
    }
}
