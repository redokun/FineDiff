<?php

namespace FineDiffTests\Diff;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Diff;

class SetTest extends TestCase
{
    public function setUp(): void
    {
        $this->diff = new Diff;
    }

    public function testSetParser()
    {
        $this->assertFalse(method_exists($this->diff->getParser(), 'fooBar'));

        $parser = $this->getMockBuilder(\cogpowered\FineDiff\Parser\Parser::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->diff->setParser($parser);

        $this->assertSame($parser, $this->diff->getParser());
    }

    public function testSetRenderer()
    {
        $this->assertFalse(method_exists($this->diff->getRenderer(), 'fooBar'));

        $html = $this->createMock(\cogpowered\FineDiff\Render\Html::class);

        $this->diff->setRenderer($html);

        $this->assertSame($html, $this->diff->getRenderer());
    }

    public function testSetGranularity()
    {
        $this->assertFalse(method_exists($this->diff->getGranularity(), 'fooBar'));

        $granularity = $this->createMock(\cogpowered\FineDiff\Granularity\Word::class);

        $parser = $this->getMockBuilder(\cogpowered\FineDiff\Parser\Parser::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parser->expects($this->once())->method('setGranularity')->with($granularity);
        $parser->expects($this->once())->method('getGranularity')->willReturn($granularity);

        $this->diff->setParser($parser);
        $this->diff->setGranularity($granularity);

        $this->assertSame($granularity, $this->diff->getGranularity());
    }
}
