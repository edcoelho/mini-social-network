<?php

namespace App\Controller;
use App\Model\User as Model;
use App\View\Render;

class User{
    public function login(){
        $model = new Model();
        $render = new Render();

        $login_response = $model->validateLogin();
        if($login_response["status"]){
            $_SESSION["user_id"] = $login_response["user"]->id;
            $_SESSION["user_name"] = $login_response["user"]->name;
            $_SESSION["user_username"] = $login_response["user"]->username;
            unset($login_response["user"]);
        }
        
        echo $render->renderJSON($login_response);
    }

    public function signup(){
        $model = new Model();
        $render = new Render();

        $signup_response = $model->validateAndDoSignup();

        echo $render->renderJSON($signup_response);
    }
}