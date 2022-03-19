<?php

namespace App\View;

class Render{
    public function render($html){
        echo $html;
    }

    public function renderPage($page, $dir = "."){
        require("pages/" . $dir . "/" . $page);
    }

    public function renderJSON($obj){
        header("Content-Type: application/json");
        return json_encode($obj);
    }

    public function renderClecks($clecks){
        foreach($clecks as $cleck){
            echo <<<HTML
                    <div class="cleck">
                        <h4>$cleck->user_name</h4>
                        <p>$cleck->text</p>
                        <span>$cleck->timestamp</span>
                    </div>\n
            HTML;
        }
    }

    public function renderHome(){
        $this->renderPage("header.html", "home");
        echo "\t<h1>{$_SESSION["user_name"]}'s homepage</h1>\n";
        $this->renderPage("post-form.html", "home");
        echo "\t<div id=\"posts-box\"></div>\n";
        $this->renderPage("footer.html", "home");
    }

    public function renderError($errCode, $msg){
        $this->renderPage("header.html", "error");
        echo <<<HTML
            <h3>Error $errCode</h3>
            <p>$msg</p>
        HTML;
        $this->renderPage("footer.html", "error");
    }
}