<?php

namespace App;

/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 22.05.19
 * Time: 22:36
 */
class Application
{
    public function run()
    {
        try {
            $route = $this->parseUri();
            echo $this->execute($route);
        } catch (\Exception $e) {
            echo $e->getCode() . ' ' . $e->getMessage();
        }
    }

    public function parseUri()
    {
        preg_match('~^(/[\d\w\.]+)\/?(\d+)?\??([\d\w\.=]+)?$~', $_SERVER['REQUEST_URI'], $matches);
        parse_str($matches[3], $params);
        return [
            'action' => $matches[1],
            'id' => $matches[2],
            'params' => $params,
        ];
    }

    public function execute($route)
    {
        //Very simple routing implementation
        $controller = new NewsController();
        if ($route['action'] == '/news' && $route['id']) {
            return $controller->actionNews($route['id']);
        } elseif ($route['action'] == '/news') {
            return $controller->actionNewsList($route['params']['page']);
        } elseif ($route['action'] == '/news.xml') {
            return $controller->actionNewsListXml($route['params']['page']);
        } else {
            throw new \Exception('Not Found', 404);
        }
    }
}
