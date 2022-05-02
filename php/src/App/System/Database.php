<?php

namespace App\System;

use Exception;
use App\System\migrations\CreateUserTable;
use function DI\env;

class Database
{

    private static $instance;
    private        $connection;

    private function __construct()
    {
        $host = $_ENV['MYSQL_HOST'];
        $db   = $_ENV['MYSQL_DATABASE'];

        $connection = new \PDO("mysql:host=$host;dbname=$db",
            $_ENV['MYSQL_USER'],
            $_ENV['MYSQL_PASSWORD']);
        // set the PDO error mode to exception
        $connection->setAttribute(\PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION);

        $this->connection = $connection;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database;
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function runMigrations()
    {
        if (!$this->tableExists('users')){
            (new CreateUserTable)->create();
        }
    }

    private function tableExists($table)
    {
        try {
            $result = $this->connection->query("SELECT 1 FROM {$table} LIMIT 1");
        } catch (Exception $e) {
            return false;
        }

        return $result !== false;
    }
}