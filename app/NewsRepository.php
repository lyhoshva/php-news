<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 23:40
 */

namespace App;

class NewsRepository
{
    protected static $model = NewsModel::class;
    protected static $table = 'news';

    public function findOne($id)
    {
        return $this->getResource()->findOne($id, ['is_published' => 1]);
    }

    public function findAll($page = 1, $perPage = 3)
    {
        return $this->getResource()->findAll($page, $perPage, ['is_published' => 1]);
    }

    private function getResource()
    {
        //DB class should be injected
        return new DB(self::$table, self::$model);
    }
}
