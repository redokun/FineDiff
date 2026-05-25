<?php

namespace FineDiffTests\Diff;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Diff;

class DependencyInjectTest extends TestCase
{
    public function testGetGranularity()
    {
        $character = $this->createMock(\cogpowered\FineDiff\Granularity\Character::class);

        $diff = new Diff($character);

        $this->assertSame($character, $diff->getGranularity());
    }

    public function testGetRenderer()
    {
        $html = $this->createMock(\cogpowered\FineDiff\Render\Html::class);

        $diff = new Diff(null, $html);

        $this->assertSame($html, $diff->getRenderer());
    }

    public function testRender()
    {
        $opcodes = $this->createMock(\cogpowered\FineDiff\Parser\Opcodes::class);
        $opcodes->method('generate')->willReturn('c12');

        $parser = $this->createMock(\cogpowered\FineDiff\Parser\Parser::class);
        $parser->method('parse')->willReturn($opcodes);

        $html = $this->createMock(\cogpowered\FineDiff\Render\Html::class);
        $html->expects($this->once())->method('process')->with('hello', $opcodes);

        $diff = new Diff(null, $html, $parser);
        $diff->render('hello', 'hello2');
    }

    public function testGetParser()
    {
        $parser = $this->getMockBuilder(\cogpowered\FineDiff\Parser\Parser::class)
            ->disableOriginalConstructor()
            ->getMock();

        $diff = new Diff(null, null, $parser);

        $this->assertSame($parser, $diff->getParser());
    }

    public function testGetOpcodes()
    {
        $parser = $this->getMockBuilder(\cogpowered\FineDiff\Parser\Parser::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parser->expects($this->once())->method('parse')->with('foobar', 'eggfooba');

        $diff = new Diff(null, null, $parser);
        $diff->getOpcodes('foobar', 'eggfooba');
    }
}
