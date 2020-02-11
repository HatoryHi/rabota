<?php

namespace application\models;

use application\core\Model;

class User extends Model
{

    public function getUsers($login)
    {
        $params = [
            'login' => $login,
        ];

        return $this->db->query('SELECT * FROM users WHERE login = :login limit 1',
            $params)->fetchAll(\PDO::FETCH_ASSOC);
    }
}