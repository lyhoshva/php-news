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
        $uri = $this->parseUri();
    }

    public function parseUri()
    {
        preg_match('~^/([\d\w\.]+)\/?(\d+)?\??([\d\w\.=]+)?$~', $_SERVER['REQUEST_URI'], $matches);
        parse_str($matches[3], $params);
        return [
            'action' => $matches[1],
            'id' => $matches[2],
            'params' => $params,
        ];
    }
}
