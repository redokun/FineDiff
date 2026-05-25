<?php

namespace FineDiffTests\Parser\Operations;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Operations\Replace;

class ReplaceTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\Operations\OperationInterface::class, new Replace('hello', 'world'));
    }

    public function testGetFromLen()
    {
        $replace = new Replace('hello', 'world');
        $this->assertEquals('hello', $replace->getFromLen());
    }

    public function testGetToLen()
    {
        $replace = new Replace('hello', 'world');
        $this->assertEquals(5, $replace->getToLen());
    }

    public function testGetText()
    {
        $replace = new Replace('foo', 'bar');
        $this->assertEquals('bar', $replace->getText());
    }

    public function testGetOpcodeSingleTextChar()
    {
        $replace = new Replace(1, 'c');
        $this->assertEquals('di:c', $replace->getOpcode());

        $replace = new Replace('r', 'c');
        $this->assertEquals('dri:c', $replace->getOpcode());

        $replace = new Replace('rob', 'c');
        $this->assertEquals('drobi:c', $replace->getOpcode());
    }

    public function testGetOpcodeLongerTextString()
    {
        $replace = new Replace(1, 'crowe');
        $this->assertEquals('di5:crowe', $replace->getOpcode());

        $replace = new Replace('r', 'crowe');
        $this->assertEquals('dri5:crowe', $replace->getOpcode());

        $replace = new Replace('rob', 'crowe');
        $this->assertEquals('drobi5:crowe', $replace->getOpcode());
    }
}
