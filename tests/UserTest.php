<?php
use App\User;
use App\Connection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;
 
    protected function setUp(): void
    {
        $this->user = new User();
    }
 
    protected function tearDown(): void
    {
        $this->user = NULL;
    }

    public function addDataProvider() {
        return [
            [
                1,
                [
                    'user_id' => 1,
                    'email'   => 'aa@aa.a',
                    'age'     => 12,
                ]
            ],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testFind(int $user_id = 0, array $result = []): void
    {
        $pdo_statment = $this->createMock(PDOStatement::class);
        $pdo_statment->expects($this->any())
            ->method('execute');
        $pdo_statment->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue($result));
        $pdo = $this->createMock(PDO::class);
        $pdo->expects($this->any())
            ->method('prepare')
            ->will($this->returnValue($pdo_statment));
        $connection = $this->createMock(Connection::class);
        $connection->expects($this->any())
            ->method('getInstance')
            ->will($this->returnValue($pdo));
        
        $user = $this->user->find($user_id);
        $this->assertEquals($result['email'], $user->email);
    }
}