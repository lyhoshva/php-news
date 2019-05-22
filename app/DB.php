<?php

namespace App;

class DB
{
    /** @var \PDO */
    private static $db;

    public function getDb()
    {
        if (empty(static::$db)) {
            // simple way to get config
            $config = require('../config/db.php');
            $dbConfig = $config['db'];
            static::$db = new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password']);
        }

        return static::$db;
    }
}
