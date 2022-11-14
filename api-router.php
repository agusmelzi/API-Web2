<?php 

require_once './libs/Router.php';
require_once './app/controllers/api-santoController.php';
require_once './app/controllers/api-authController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('santos', 'GET', 'apiSantoController', 'home');
$router->addRoute('santos/:ID', 'GET', 'apiSantoController', 'detalle');
$router->addRoute('santos/:ID', 'DELETE', 'apiSantoController', 'delete');
$router->addRoute('santos', 'POST', 'apiSantoController', 'addSaint');
$router->addRoute('santos/:ID', 'PUT', 'apiSantoController', 'editarSanto');

$router->addRoute('token', 'GET', 'AuthApiController', 'getToken');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

?>