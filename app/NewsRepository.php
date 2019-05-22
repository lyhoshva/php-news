<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 23:40
 */

namespace App;

class NewsRepository
{
    private $model = NewsModel::class;

    public function findOne($id)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `news` WHERE id=:id');
        $statement->execute([':id' => $id]);
        return $statement->fetchObject(NewsModel::class);
    }

    public function findAll($page = 1, $perPage = 3)
    {
        $db = (new DB())->getDb();
        $statement = $db->prepare('SELECT * FROM `news` LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $perPage, \PDO::PARAM_INT);
        $statement->bindValue(':offset', ($page - 1) * $perPage, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, $this->model);
    }
}
