<?php

namespace FineDiffTests\Parser\Operations;

use PHPUnit\Framework\TestCase;
use cogpowered\FineDiff\Parser\Operations\Delete;

class DeleteTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $this->assertInstanceOf(\cogpowered\FineDiff\Parser\Operations\OperationInterface::class, new Delete(10));
    }

    public function testGetFromLen()
    {
        $delete = new Delete(10);
        $this->assertEquals(10, $delete->getFromLen());
    }

    public function testGetToLen()
    {
        $delete = new Delete(342);
        $this->assertEquals(0, $delete->getToLen());
    }

    public function testGetOpcode()
    {
        $delete = new Delete(1);
        $this->assertEquals('d', $delete->getOpcode());

        $delete = new Delete(24);
        $this->assertEquals('d24', $delete->getOpcode());
    }
}
