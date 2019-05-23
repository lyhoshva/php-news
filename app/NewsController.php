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
        $this->setHeader('Content-Type', 'text/xml');

        return $this->render('newsListXml', [
            'newsList' => $newsList,
        ]);
    }

    public function actionNews($id)
    {
        $repository = new NewsRepository();
        /** @var NewsModel $news */
        $news = $repository->findOne($id);
        if (!$news) {
            //Code must be constant
            throw new \Exception('Not Found', 404);
        }

        //random news
        $newsList = (new NewsRepository())->findAll();

        return $this->render('news', [
            'news' => $news,
            'newsList' => $newsList,
        ]);
    }
}
