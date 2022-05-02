<?php

namespace App\System\migrations;

use App\System\Database;

class CreateUserTable
{
    public function create()
    {
        $sql = "CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

        Database::getInstance()
            ->getConnection()
            ->exec($sql);
    }
}