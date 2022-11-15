<?php 

require_once './libs/Router.php';
require_once './app/controllers/api-saintController.php';
require_once './app/controllers/api-authController.php';

$router = new Router();

$router->addRoute('saints', 'GET', 'apiSaintController', 'home');
$router->addRoute('saints/:ID', 'GET', 'apiSaintController', 'detail');
$router->addRoute('saints/:ID', 'DELETE', 'apiSaintController', 'delete');
$router->addRoute('saints', 'POST', 'apiSaintController', 'addSaint');
$router->addRoute('saints/:ID', 'PUT', 'apiSaintController', 'editSaint');

$router->addRoute('congregations', 'GET', 'apiSaintController', 'getCongregations');

$router->addRoute('token', 'GET', 'AuthApiController', 'getToken');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
