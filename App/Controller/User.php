<?php

namespace App\Controller;
use App\Model\User as Model;
use App\View\View;

class User{
    public function login(){
        $model = new Model();
        $view = new View();

        $login_response = $model->validateLogin();
        if($login_response["status"]){
            $_SESSION["user_id"] = $login_response["user"]->id;
            $_SESSION["user_name"] = $login_response["user"]->name;
            $_SESSION["user_nickname"] = $login_response["user"]->nickname;
            unset($login_response["user"]);
        }
        
        echo $view->renderJSON($login_response);
    }
}