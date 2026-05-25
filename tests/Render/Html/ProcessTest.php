<?php

namespace FineDiffTests\Render\Html;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Render\Html;

class ProcessTest extends TestCase
{
    protected Html $html;

    public function setUp(): void
    {
        $this->html = new Html;
    }

    public function testProcess()
    {
        $opcodes = $this->createMock(\cogpowered\FineDiff\Parser\Opcodes::class);
        $opcodes->expects($this->once())->method('generate')->willReturn('c5i:2c6d');

        $html = $this->html->process('Hello worlds', $opcodes);

        $this->assertEquals($html, 'Hello<ins>2</ins> world<del>s</del>');
    }
}
