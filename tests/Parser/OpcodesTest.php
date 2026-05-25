<?php

namespace FineDiffTests\Parser;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Opcodes;

class OpcodesTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\OpcodesInterface::class, new Opcodes);
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
        $this->assertEquals('testing', $opcodes[0]);
    }

    public function testNotOperation()
    {
        $this->expectException(\cogpowered\FineDiff\Exceptions\OperationException::class);
        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array('test'));
    }

    public function testGetOpcodes()
    {
        $operation_one = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $opcodes = $opcodes->getOpcodes();

        $this->assertIsArray($opcodes);
        $this->assertEquals('c5i', $opcodes[0]);
        $this->assertEquals('2c6d', $opcodes[1]);
    }

    public function testGenerate()
    {
        $operation_one = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals('c5i2c6d', $opcodes->generate());
    }

    public function testToString()
    {
        $operation_one = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_one->method('getOpcode')->willReturn('c5i');

        $operation_two = $this->createStub(\cogpowered\FineDiff\Parser\Operations\Copy::class);
        $operation_two->method('getOpcode')->willReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals('c5i2c6d', (string)$opcodes);
        $this->assertEquals($opcodes->generate(), (string)$opcodes);
    }
}
