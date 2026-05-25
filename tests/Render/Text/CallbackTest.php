<?php

namespace FineDiffTests\Render\Text;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Render\Text;

class CallbackTest extends TestCase
{
    protected Text $text;

    public function setUp(): void
    {
        $this->text = new Text;
    }

    public function testCopy()
    {
        $this->assertEquals('Hello', $this->text->callback('c', 'Hello', 0, 5));
        $this->assertEquals('Hel', $this->text->callback('c', 'Hello', 0, 3));
    }

    public function testDelete()
    {
        $this->assertEquals('', $this->text->callback('d', 'elephant', 0, 100));
        $this->assertEquals('', $this->text->callback('d', "elephant", 3, 4));
    }

    public function testInsert()
    {
        $this->assertEquals('monkey', $this->text->callback('i', 'monkey', 0, 6));
        $this->assertEquals('nke', $this->text->callback('i', 'monkey', 2, 3));
    }
}
