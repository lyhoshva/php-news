<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 23.05.19
 * Time: 23:18
 */

namespace App;

class Controller
{
    public function render($view, $params = [])
    {
        return (new View())->render($view, $params);
    }
}
