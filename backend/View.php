<?php

class View
{
    public function renderView($view, $params = [])
    {
        $view = $this->renderOnlyView($view, $params);
        $layout = $this->renderLayout();
        return str_replace('{{content}}', $view, $layout);
    }

    protected function renderLayout()
    {
        ob_start();
        include_once dirname(__DIR__) . "/frontend/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = null)
    {
        if ($params != null) {
            foreach ($params as $key => $value) {
                $$key = $value;
            }
        }
        ob_start();
        include_once dirname(__DIR__) . "/frontend/pages/$view.php";
        return ob_get_clean();
    }
}