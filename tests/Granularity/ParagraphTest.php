<?php

namespace FineDiffTests\Granularity;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Paragraph;

class ParagraphTest extends TestCase
{
    protected Paragraph $character;

    protected array $delimiters = [
        Delimiters::PARAGRAPH,
    ];

    public function setUp(): void
    {
        $this->character = new Paragraph;
    }

    public function testExtendsAndImplements()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Granularity\Granularity::class, $this->character);
        $this->assertInstanceOf(\cogpowered\FineDiff\Granularity\GranularityInterface::class, $this->character);
        $this->assertInstanceOf(\ArrayAccess::class, $this->character);
        $this->assertInstanceOf(\Countable::class, $this->character);
    }

    public function testGetDelimiters()
    {
        $this->assertEquals($this->delimiters, $this->character->getDelimiters());
    }
}
