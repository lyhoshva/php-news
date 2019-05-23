<?php

namespace App;

class DB implements DataResourceInterface
{
    /** @var \PDO */
    private static $db;
    private $table;
    private $model;

    public function __construct($table, $model)
    {
        $this->table = $table;
        $this->model = $model;
    }

    private function getDb()
    {
        if (empty(static::$db)) {
            // Hotfix. Simple way to get config
            $config = require('../config/db.php');
            $dbConfig = $config['db'];
            static::$db = new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['password']);
        }

        return static::$db;
    }

    public function findOne($id, $where = [])
    {
        $db = $this->getDb();
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE id=:id';
        foreach ($where as $field => $value) {
            $sql .= ' AND ' . $field . '=:' . $field;
        }
        $statement = $db->prepare($sql);
        foreach ($where as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchObject($this->model);
    }

    public function findAll($page = 1, $perPage = 3, $where = [])
    {
        $db = $this->getDb();
        $sql = 'SELECT * FROM `' . $this->table . '`';

        $whereParams = [];
        foreach ($where as $field => $value) {
            $whereParams[] = $field . '=:' . $field;
        }
        if (!empty($whereParams)) {
            $sql .= ' WHERE ' . implode(' AND ', $whereParams);
        }
        $sql .= ' LIMIT :limit OFFSET :offset';
        $statement = $db->prepare($sql);
        foreach ($where as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }
        $statement->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $statement->bindValue(':offset', ($page - 1) * $perPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->model);
    }
}
