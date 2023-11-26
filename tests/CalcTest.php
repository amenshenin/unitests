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

    public function addDataProvider() {
        return [
            [2.0, 1.0, 2,0],
            [4.0, 2.0, 2,0],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testDivide($dividend, $divider, $res): void
    {
        $result = $this->calc->divide($dividend, $divider);
        $this->assertEquals($res, $result);
    }

    public function testException(): void
    {
        $this->expectException(Exception::class);
        $this->calc->divide(2.0, 0);
    }
}