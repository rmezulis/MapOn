<?php

namespace App\Controllers;

use App\System\Database;

class LoginController
{
    public static function loginPage()
    {
        require_once __DIR__ . "/../../views/login.php";
    }

    public static function login()
    {
        if ( !empty($_POST)) {
            $username = strip_tags(trim($_POST['user']));
            $password = strip_tags(trim($_POST['password']));
            $db       = Database::getInstance()
                ->getConnection();
            $sql      = "SELECT * FROM users WHERE username = :user";
            $query    = $db->prepare($sql);
            $query->execute([
                'user' => $username,
            ]);
            $result = $query->fetch();
            if ( !empty($result) && password_verify($password,
                    $result['password'])
            ) {
                $_SESSION['user'] = $result['username'];

                return MaponController::view();
            } else {
                $_SESSION['errors'] = 'User not found';
            }
        }
    }
}