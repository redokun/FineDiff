<?php

namespace FineDiffTests\Parser;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Opcodes;

class OpcodesTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertTrue(is_a(new Opcodes, 'cogpowered\FineDiff\Parser\OpcodesInterface'));
    }

    public function testEmptyOpcodes()
    {
        $opcodes = new Opcodes;
        $this->assertEmpty($opcodes->getOpcodes());
    }

    public function testSetOpcodes()
    {
        $operation = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation->expects($this->once())->method('getOpcode')->willReturn('testing');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation));

        $opcodes = $opcodes->getOpcodes();
        $this->assertEquals($opcodes[0], 'testing');
    }

    public function testNotOperation()
    {
        $this->expectException(\cogpowered\FineDiff\Exceptions\OperationException::class);
        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array('test'));
    }

    public function testGetOpcodes()
    {
        $operation_one = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $opcodes = $opcodes->getOpcodes();

        $this->assertTrue(is_array($opcodes));
        $this->assertEquals($opcodes[0], 'c5i');
        $this->assertEquals($opcodes[1], '2c6d');
    }

    public function testGenerate()
    {
        $operation_one = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals($opcodes->generate(), 'c5i2c6d');
    }

    public function testToString()
    {
        $operation_one = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createMock(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals((string)$opcodes, 'c5i2c6d');
        $this->assertEquals((string)$opcodes, $opcodes->generate());
    }
}
