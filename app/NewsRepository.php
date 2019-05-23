<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 23:40
 */

namespace App;

class NewsRepository extends Repository
{
    private static $model = NewsModel::class;
    private static $table = 'news';

    //Other specific methods for news repository
}
