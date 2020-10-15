<?php

namespace Api\Database;

use Dcblogdev\PdoWrapper\Database;

class DatabaseFactory
{
    private function getMySQL()
    {
        return [
            //required
            'username' => 'root',
            'database' => 'mailer',
            //optional
            'password' => 'secret',
            'type' => 'mysql',
            'charset' => 'utf8',
            'host' => 'mysql',
            'port' => '3306'
        ];
    }

    public function getInstance()
    {
        return new Database($this->getMySQL());
    }
}
