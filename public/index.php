<?php

define("PROJECT_PATH", dirname(__DIR__));

require_once PROJECT_PATH . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

session_start();

$router = new Router("http://localhost/Portfólio/Cleckr");
$router->namespace("App\Controller");

$router->group(null);
$router->get("/", "App:index");

$router->group("user");
$router->post("/login", "User:login");

$router->group("cleck");
$router->get("/get", "Home:getClecks");
$router->post("/post", "Home:postCleck");

$router->dispatch();