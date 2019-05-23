<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 23:40
 */

namespace App;

class NewsRepository
{
    private static $model = NewsModel::class;

    public static function findOne($id)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `news` WHERE id=:id');
        $statement->execute([':id' => $id]);
        return $statement->fetchObject(static::$model);
    }

    public static function findAll($page = 1, $perPage = 3)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `news` LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $statement->bindValue(':offset', ($page - 1) * $perPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, static::$model);
    }
}
