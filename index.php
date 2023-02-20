<?php
include 'autoload.php';
include 'config.php';

$Application = new Application();
$Application->route->get('/', [ProductController::class, 'ProductList']);
$Application->route->get('/addProduct', [ProductController::class, 'addProduct']);
$Application->route->post('/addProduct', [ProductController::class, 'addProduct']);
$Application->route->post('/deleteProduct', [ProductController::class, 'deleteProduct']);
$Application->run();