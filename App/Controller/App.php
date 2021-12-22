<?php

namespace App\Controller;
use App\View\View;

class App{
    public function index(){
        $view = new View();

        if(isset($_SESSION["user_id"])){
            $view->renderHome();
        }else{
            $view->renderPage("login.html");
        }
    }
}