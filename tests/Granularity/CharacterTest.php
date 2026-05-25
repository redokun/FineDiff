<?php

namespace FineDiffTests\Granularity;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Character;

class CharacterTest extends TestCase
{
    protected Character $character;

    protected array $delimiters = [
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
        Delimiters::WORD,
        Delimiters::CHARACTER,
    ];

    public function setUp(): void
    {
        $this->character = new Character;
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

    public function testSetDelimiters()
    {
        $arr = array('one', 'two');
        $this->character->setDelimiters($arr);
        $this->assertEquals($arr, $this->character->getDelimiters());
    }

    public function testCountable()
    {
        $this->assertCount(count($this->delimiters), $this->character);
    }

    public function testArrayAccess()
    {
        // Exists
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            if ($i !== count($this->delimiters)) {
                $this->assertTrue(isset($this->character[$i]));
            } else {
                $this->assertFalse(isset($this->character[$i]));
            }
        }

        // Get
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            if ($i !== count($this->delimiters)) {
                $this->assertEquals($this->delimiters[$i], $this->character[$i]);
            } else {
                $this->assertNull($this->character[$i]);
            }
        }

        // Set
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            $rand = rand(0, 1000);
            $this->character[$i] = $rand;
            $this->assertEquals($rand, $this->character[$i]);
        }

        $this->assertCount(count($this->delimiters) + 1, $this->character);

        // Unset
        unset($this->character[count($this->delimiters)]);
        $this->assertCount(count($this->delimiters), $this->character);
    }
}
