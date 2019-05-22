<?php
/**
 * User: lyhoshva lyhoshvavlad@gmail.com
 * Date: 23.05.19
 * Time: 0:44
 */

namespace App;

class View
{
    public function render($view, $params = [])
    {
        extract($params);
        ob_start();
        require($this->getViewPath($view));
        $output = ob_get_clean();

        return $output;
    }

    private function getViewPath($viewName)
    {
        //Should be retrieved from config or smth like that
        return '../views/' . $viewName . '.php';
    }
}
