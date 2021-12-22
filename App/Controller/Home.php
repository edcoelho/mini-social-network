<?php

namespace App\Controller;
use App\Model\Post;
use App\View\View;

class Home{

    public function getClecks(){
        $model = new Post();
        $clecks = $model->selectRecent($_SESSION["user_id"], $_GET["offset"]);

        $view = new View();
        $view->renderClecks($clecks);
    }

    public function postCleck(){
        $model = new Post();
        $model->insert($_POST["text"], "", $_SESSION["user_id"]);
    }
}