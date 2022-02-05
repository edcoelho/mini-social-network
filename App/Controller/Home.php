<?php

namespace App\Controller;
use App\Model\Cleck;
use App\View\Render;

class Home{

    public function getClecks(){
        $model = new Cleck();
        $clecks = $model->selectRecent($_SESSION["user_id"], $_GET["offset"]);

        $render = new Render();
        $render->renderClecks($clecks);
    }

    public function postCleck(){
        $model = new Cleck();
        $model->insert($_POST["text"], "", $_SESSION["user_id"]);
    }
}