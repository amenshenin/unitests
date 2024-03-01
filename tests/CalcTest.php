<?php

use App\Calc;
use PHPUnit\Framework\TestCase;

class CalcTest extends TestCase
{
    private $calc;
    protected function setUp(): void
    {
        $this->calc = new Calc();
    }

    protected function tearDown(): void
    {
        $this->calc = NULL;
    }

    /**
    * @dataProvider addDataProvider
    */
    public function testEqualPlus($a, $b, $result): void
    {
        $this->assertEquals($this->calc->plus($a, $b), $result);
    } 

    public function addDataProvider() {
        return [
            [2.0, 1.0, 3.0],
            [4.0, 2.0, 6.0],
            [4000000000000000000000000000000000000000000000000, 2000000000000000000000000000000000000000000000000, 6000000000000000000000000000000000000000000000000],
        ];
    }
}

