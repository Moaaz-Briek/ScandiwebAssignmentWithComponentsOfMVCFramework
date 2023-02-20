<?php

class Application
{
    public static Application $app;
    public Route $route;
    public Request $request;
    public Response $response;
    public View $view;
    public DatabaseConnection $Db;

    public function __construct()
    {
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->route = new Route($this->request);
        $this->Db = new DatabaseConnection();
    }

    public function run()
    {
        try {
            echo $this->route->resolve();
        } catch (\Exception $e) {
            echo $e->getMessage();
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('errors', ['exception' => $e]);
        }
    }
}