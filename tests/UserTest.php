<?php

use App\Connection;
use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $pdo;
    private $user;
 
    protected function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
        $this->user = new User($this->pdo);
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
                    'email'   => 'test@test.test',
                    'age'     => 12,
                ]
            ],
        ];
    }

    /**
    * @dataProvider addDataProvider
    */
    public function testFind($user_id, $result)
    {
        $pdo_statement = $this->createMock(PDOStatement::class);

        $this->pdo->expects($this->any())
            ->method('prepare')
            ->will($this->returnValue($pdo_statement));

        $pdo_statement->expects($this->any())
            ->method('execute');

        $pdo_statement->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue($result));

        $user = $this->user->find($user_id);
        $this->assertEquals($user->email, $result['email']);
    }
}