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
        /** @var NewsModel[] $newsList */
        $newsList = (new NewsRepository())->findAll($page);

        return $this->render('newsList', [
            'newsList' => $newsList,
        ]);
    }

    public function actionNewsListXml($page)
    {
        /** @var NewsModel[] $newsList */
        $newsList = (new NewsRepository())->findAll($page);

        return $this->render('newsListXml', [
            'newsList' => $newsList,
        ]);
    }

    public function actionNews($id)
    {
        /** @var NewsModel $news */
        $news = (new NewsRepository())->findOne($id);
        if (!$news) {
            //Code must be constant
            throw new \Exception('Not Found', 404);
        }

        return $this->render('news', [
            'news' => $news,
        ]);
    }
}
