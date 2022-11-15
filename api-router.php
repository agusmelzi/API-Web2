<?php 

require_once './libs/Router.php';
require_once './app/controllers/api-saintController.php';
require_once './app/controllers/api-authController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('santos', 'GET', 'apiSaintController', 'home');
$router->addRoute('santos/:ID', 'GET', 'apiSaintController', 'detail');
$router->addRoute('santos/:ID', 'DELETE', 'apiSaintController', 'delete');
$router->addRoute('santos', 'POST', 'apiSaintController', 'addSaint');
$router->addRoute('santos/:ID', 'PUT', 'apiSaintController', 'editSaint');

$router->addRoute('token', 'GET', 'AuthApiController', 'getToken');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>