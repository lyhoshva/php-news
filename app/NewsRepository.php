<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 23:40
 */

namespace App;

class NewsRepository extends Repository
{
    protected static $model = NewsModel::class;
    protected static $table = 'news';

    public function findOne($id, $where = [])
    {
        $where = array_merge($where, ['is_published' => 1]);
        return parent::findOne($id, $where);
    }

    public function findAll($where = [], $page = 1, $perPage = 3)
    {
        $where = array_merge($where, ['is_published' => 1]);
        return parent::findAll($where, $page, $perPage);
    }
}
