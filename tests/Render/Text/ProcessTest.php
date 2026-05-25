<?php

namespace FineDiffTests\Render\Text;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Render\Text;

class ProcessTest extends TestCase
{
    public function setUp(): void
    {
        $this->text = new Text;
    }

    public function testInvalidOpcode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->text->process('Hello worlds', 123);
    }

    public function testProcessWithString()
    {
        $html = $this->text->process('Hello worlds', 'c5i:2c6d');

        $this->assertEquals($html, 'Hello2 world');
    }

    public function testProcess()
    {
        $opcodes = $this->createMock(\cogpowered\FineDiff\Parser\Opcodes::class);
        $opcodes->expects($this->once())->method('generate')->willReturn('c5i:2c6d');

        $html = $this->text->process('Hello worlds', $opcodes);

        $this->assertEquals($html, 'Hello2 world');
    }
}
