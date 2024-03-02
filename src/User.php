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

    public function __construct(PDO $db)
    {
        $this->db = $db;
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

    public function add(array $user_data = []): ?int
    {
        if (empty($user_data['email']) || empty($user_data['age'])) {
            return null;
        }
        $sth = $this->db->prepare('INSERT INTO users (email, age) VALUES (:email, :age)');
        $sth->bindValue(':email', $user_data['email'], PDO::PARAM_STR);
        $sth->bindValue(':age', $user_data['age'], PDO::PARAM_INT);
        $sth->execute();
        return $this->db->lastInsertId();
    }
}