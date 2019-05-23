<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 23.05.19
 * Time: 23:30
 */

namespace App;

class Repository
{
    private static $model;
    private static $table;

    public static function findOne($id)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `' . static::$table . '` WHERE id=:id');
        $statement->execute([':id' => $id]);
        return $statement->fetchObject(static::$model);
    }

    public static function findAll($page = 1, $perPage = 3)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `' . static::$table . '` LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $statement->bindValue(':offset', ($page - 1) * $perPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::$model);
    }
}
