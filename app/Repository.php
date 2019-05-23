<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 23.05.19
 * Time: 23:30
 */

namespace App;

class Repository implements DataResourceInterface
{
    protected static $model;
    protected static $table;

    public function findOne($id, $where = [])
    {
        $db = (new DB())->getDb();
        $sql = 'SELECT * FROM `' . static::$table . '` WHERE id=:id';
        foreach ($where as $field => $value) {
            $sql .= ' AND ' . $field . '=:' . $field;
        }
        $statement = $db->prepare($sql);
        foreach ($where as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetchObject(static::$model);
    }

    public function findAll($page = 1, $perPage = 3, $where = [])
    {
        $db = (new DB())->getDb();
        $sql = 'SELECT * FROM `' . static::$table . '` LIMIT :limit OFFSET :offset';
        foreach ($where as $field => $value) {
            $sql .= ' AND ' . $field . '=:' . $field;
        }
        $statement = $db->prepare($sql);
        foreach ($where as $field => $value) {
            $statement->bindValue(':' . $field, $value);
        }
        $statement->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $statement->bindValue(':offset', ($page - 1) * $perPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::$model);
    }
}
