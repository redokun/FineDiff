<?php

namespace FineDiffTests\Diff;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Diff;

class DefaultsTest extends TestCase
{
    protected Diff $diff;

    public function setUp(): void
    {
        $this->diff = new Diff;
    }

    public function testGetGranularity()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Granularity\Character::class, $this->diff->getGranularity());
        $this->assertInstanceOf(\cogpowered\FineDiff\Granularity\Granularity::class, $this->diff->getGranularity());
        $this->assertInstanceOf(\cogpowered\FineDiff\Granularity\GranularityInterface::class, $this->diff->getGranularity());
    }

    public function testGetRenderer()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Render\Html::class, $this->diff->getRenderer());
        $this->assertInstanceOf(\cogpowered\FineDiff\Render\Renderer::class, $this->diff->getRenderer());
        $this->assertInstanceOf(\cogpowered\FineDiff\Render\RendererInterface::class, $this->diff->getRenderer());
    }

    public function testGetParser()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\Parser::class, $this->diff->getParser());
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\ParserInterface::class, $this->diff->getParser());
    }
}
