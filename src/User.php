<?php
namespace App;

use App\Connection;
use Exception;
use PDO;

class User
{
    private $db = null;
    public $user_id = 0;
    public $email = 0;
    public $age = 0;

    public function __construct(int $user_id = 0)
    {
        $this->db = Connection::getInstance();
        if (!empty($user_id)) {
            $this->find($user_id);
        }
    }

    public function find(int $user_id = 0): ?self
    {
        $sth = $this->db->prepare('SELECT user_id, email, age FROM users WHERE user_id = :user_id');
        $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch();
        if (!empty($result['user_id'])) {
            $this->user_id = $result['user_id'];
            $this->email = $result['email'] ?? '';
            $this->age = $result['age'] ?? 0;
            return $this;
        } else {
            return null;
        }
    }
}