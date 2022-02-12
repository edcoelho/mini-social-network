<?php

namespace App\Controller;
use App\View\Render;

class App{
    public function index(){
        $render = new Render();

        if(isset($_SESSION["user_id"])){
            $render->renderHome();
        }else{
            $render->renderPage("login.html");
        }
    }

    public function signup(){
        $render = new Render();
        
        if(isset($_SESSION["user_id"])){
            header("location: ./");
        }else{
            $render->renderPage("signup.html");
        }
    }
}