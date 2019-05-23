<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 23.05.19
 * Time: 23:19
 */

namespace App;

class NewsController extends Controller
{
    public function actionNewsList($page)
    {
        $newsList = NewsRepository::findAll($page);

        return $this->render('newsList', [
            'newsList' => $newsList,
        ]);
    }

    public function actionNewsListXml($page)
    {
        $newsList = NewsRepository::findAll($page);

        return $this->render('newsListXml', [
            'newsList' => $newsList,
        ]);
    }

    public function actionNews($id)
    {
        /** @var NewsModel $news */
        $news = NewsRepository::findOne($id);
        if (!$news) {
            throw new \Exception('404 Not Found');
        }

        return $this->render('news', [
            'news' => $news,
        ]);
    }
}
