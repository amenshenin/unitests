<?php
namespace App;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private $dbh;

    private const HOST ='learning1-db';
    private const USER = 'root';
    private const PASSWORD ='root';
    private const DATABASE = 'example';

    private function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=' . static::HOST . ';dbname=' . static::DATABASE, static::USER, static::PASSWORD);
        } catch (PDOException $e) {
            die('Failed to connect to database: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        } else {
            // Check connection reliability by performing a test query
            try {
                self::$instance->dbh->query('SELECT 1');
            } catch (PDOException $e) {
                // If an error occurred, the connection is lost and needs to be restored
                self::$instance = new self();
            }
        }

        return self::$instance->dbh;
    }

    public function __destruct()
    {
        $this->dbh = null;
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }
}