<?php

define("PROJECT_PATH", dirname(__DIR__));

require_once PROJECT_PATH . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

session_start();

$router = new Router(DOMAIN);
$router->namespace("App\Controller");

$router->group(null);
$router->get("/", "App:index");
$router->get("/signup", "App:signup");

$router->group("user");
$router->post("/login", "User:login");
$router->post("/signup", "User:signup");
$router->get("/logout", "User:logout");

$router->group("cleck");
$router->get("/get", "Home:getClecks");
$router->post("/post", "Home:postCleck");

$router->group("error");
$router->get("/{errCode}", "App:routeError");

$router->dispatch();

if($router->error()){
    $router->redirect("/error/{$router->error()}");
}