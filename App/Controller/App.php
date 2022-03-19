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

    public function routeError($params){
        $render = new Render();

        $errCode = (int)$params["errCode"];
        $msg = "";

        switch($errCode){
            case 400:
                $msg = "Invalid request.";
                break;
            case 404:
                $msg = "Page not found.";
                break;
            case 405:
                $msg = "Method not supported!";
                break;
            case 501:
                $msg = "Method not implemented!";
                break;
            default:
                $msg = "Something went wrong :(";
                break;
        }

        $render->renderError($errCode, $msg);
    }
}