<?php

namespace FineDiffTests\Delimiters;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Delimiters;

class ConstantsTest extends TestCase
{
    public function testParagraphConstant()
    {
        $this->assertEquals("\n\r", Delimiters::PARAGRAPH);
    }

    public function testSentenceConstant()
    {
        $this->assertEquals(".\n\r", Delimiters::SENTENCE);
    }

    public function testWordConstant()
    {
        $this->assertEquals(" \t.\n\r", Delimiters::WORD);
    }

    public function testCharacterConstant()
    {
        $this->assertEquals("", Delimiters::CHARACTER);
    }
}
