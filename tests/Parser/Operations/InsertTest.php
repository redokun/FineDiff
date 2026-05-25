<?php

namespace FineDiffTests\Parser\Operations;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Operations\Insert;

class InsertTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\Operations\OperationInterface::class, new Insert('hello world'));
    }

    public function testGetFromLen()
    {
        $insert = new Insert('hello world');
        $this->assertEquals(0, $insert->getFromLen());
    }

    public function testGetToLen()
    {
        $insert = new Insert('hello world');
        $this->assertEquals(11, $insert->getToLen());
    }

    public function testGetText()
    {
        $insert = new Insert('foobar');
        $this->assertEquals('foobar', $insert->getText());
    }

    public function testGetOpcode()
    {
        $insert = new Insert('C');
        $this->assertEquals('i:C', $insert->getOpcode());

        $insert = new Insert('blue');
        $this->assertEquals('i4:blue', $insert->getOpcode());
    }
}
