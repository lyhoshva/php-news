<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 24.05.19
 * Time: 0:14
 */

namespace App;


interface DataResourceInterface
{
    public function findOne($id, $where);
    public function findAll($where = [], $page = 1, $perPage = 3);
}