<?php
class ProductController
{
    public Product $product;
    public Request $request;
    protected array $types = [
      'dvd' => 'DvdProduct',
      'furniture' => 'FurnitureProduct',
      'book' => 'BookProduct',
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->product = $this->GetProductType();
    }

    public function GetProductType()
    {
        $inputs = [];
        if($this->request->isPost()) {
            $inputs = $this->request->getBody();
        }
        if (array_key_exists('type', $inputs)) {
            $type = $inputs['type'];
            return new $this->types[$type]();
        } else {
            return new Product();
        }

    }

    public function ProductList()
    {
        $products = $this->product->findAll();
        return Application::$app->view->renderView('ProductList', ['products' => $products]);
    }

    public function addProduct(Request $request)
    {
        if($request->isPost()) {
            $inputs = $request->getBody();
            $this->product->loadData($inputs);
            if($this->product->validate() && $this->product->save()) {
                Application::$app->response->redirect('/');
            }
        }
        return Application::$app->view->renderView('/AddProduct', ['model' => $this->product]);
    }

    public function deleteProduct(Request $request)
    {
        if ($request->isPost()) {
            $ids = $request->getBody();
            $this->product->delete($ids);
            Application::$app->response->redirect('/');
        }
    }
};