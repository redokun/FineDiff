<?php

namespace FineDiffTests\Delimiters;

use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testCantInstantiate()
    {
        $class = new \ReflectionClass(\cogpowered\FineDiff\Delimiters::class);
        $this->assertTrue($class->getMethod('__construct')->isPrivate());
    }
}
