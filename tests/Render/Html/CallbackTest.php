<?php

namespace FineDiffTests\Render\Html;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Render\Html;

class CallbackTest extends TestCase
{
    protected Html $html;

    public function setUp(): void
    {
        $this->html = new Html;
    }

    public function testCopy()
    {
        $this->assertEquals('Hello', $this->html->callback('c', 'Hello', 0, 5));
        $this->assertEquals('He&amp;llo', $this->html->callback('c', 'He&llo', 0, 100));
    }

    public function testDelete()
    {
        $this->assertEquals('<del>el</del>', $this->html->callback('d', 'el', 0, 2));
        $this->assertEquals('<del>e&amp;l</del>', $this->html->callback('d', "e&l", 0, 100));
    }

    public function testInsert()
    {
        $this->assertEquals('<ins>monkey</ins>', $this->html->callback('i', 'monkey', 0, 6));
        $this->assertEquals('<ins>mon&amp;key</ins>', $this->html->callback('i', "mon&key", 0, 100));
    }
}
