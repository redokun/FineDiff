<?php

namespace FineDiffTests\Usage;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Render\Text;
use cogpowered\FineDiff\Render\Html;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Granularity\Sentence;
use cogpowered\FineDiff\Granularity\Paragraph;

class SimpleTest extends Base
{
    public function testInsertCharacterGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('character/simple');

        $diff = new Diff(new Character);
        $generated_opcodes = $diff->getOpcodes($from, $to);

        $this->assertEquals($opcodes, $generated_opcodes);
        $this->assertEquals($to, (new Text)->process($from, $generated_opcodes));
        $this->assertEquals($html, (new Html)->process($from, $generated_opcodes));
        $this->assertEquals($html, $diff->render($from, $to));
    }

    public function testInsertWordGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('word/simple');

        $diff = new Diff(new Word);
        $generated_opcodes = $diff->getOpcodes($from, $to);

        $this->assertEquals($opcodes, $generated_opcodes);
        $this->assertEquals($to, (new Text)->process($from, $generated_opcodes));
        $this->assertEquals($html, (new Html)->process($from, $generated_opcodes));
        $this->assertEquals($html, $diff->render($from, $to));
    }

    public function testInsertSentenceGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('sentence/simple');

        $diff = new Diff(new Sentence);
        $generated_opcodes = $diff->getOpcodes($from, $to);

        $this->assertEquals($opcodes, $generated_opcodes);
        $this->assertEquals($to, (new Text)->process($from, $generated_opcodes));
        $this->assertEquals($html, (new Html)->process($from, $generated_opcodes));
        $this->assertEquals($html, $diff->render($from, $to));
    }

    public function testInsertParagraphGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('paragraph/simple');

        $diff = new Diff(new Paragraph);
        $generated_opcodes = $diff->getOpcodes($from, $to);

        $this->assertEquals($opcodes, $generated_opcodes);
        $this->assertEquals($to, (new Text)->process($from, $generated_opcodes));
        $this->assertEquals($html, (new Html)->process($from, $generated_opcodes));
        $this->assertEquals($html, $diff->render($from, $to));
    }
}
