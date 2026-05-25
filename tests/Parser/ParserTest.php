<?php

namespace FineDiffTests\Parser;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Parser\Parser;

class ParserTest extends TestCase
{
    protected Parser $parser;

    public function setUp(): void
    {
        $granularity  = new Character;
        $this->parser = new Parser($granularity);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\ParserInterface::class, $this->parser);
    }

    public function testDefaultOpcodes()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\OpcodesInterface::class, $this->parser->getOpcodes());
    }

    public function testSetOpcodes()
    {
        $opcodes = $this->createStub(\cogpowered\FineDiff\Parser\Opcodes::class);
        $this->parser->setOpcodes($opcodes);

        $this->assertSame($opcodes, $this->parser->getOpcodes());
    }

    public function testParseBadGranularity()
    {
        $this->expectException(\cogpowered\FineDiff\Exceptions\GranularityCountException::class);
        $granularity = $this->createStub(\cogpowered\FineDiff\Granularity\Character::class);
        $granularity->method('count')->willReturn(0);
        $parser = new Parser($granularity);

        $parser->parse('hello world', 'hello2 worl');
    }

    public function testParseSetOpcodes()
    {
        $opcodes = $this->createMock(\cogpowered\FineDiff\Parser\Opcodes::class);
        $opcodes->expects($this->once())->method('setOpcodes');
        $this->parser->setOpcodes($opcodes);

        $this->parser->parse('Hello worlds', 'Hello2 world');
    }
}
