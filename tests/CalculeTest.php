<?php

namespace App\Tests;

use App\Entity\Calcule;
use PHPUnit\Framework\TestCase;

class CalculeTest extends TestCase
{
    public function testAdd()
    {
        $Calcule = new Calcule();
        $result = $Calcule->add(30, 12);

        $this->assertEquals(42, $result);
    }

    public function testSub()
    {
        $Calcule = new Calcule();
        $result = $Calcule->sub(3, 2);

        $this->assertEquals(1, $result);
    }
}
