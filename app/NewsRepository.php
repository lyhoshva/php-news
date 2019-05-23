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

    //Other specific methods for news repository
}
