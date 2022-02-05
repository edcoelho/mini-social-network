<?php

namespace App\Model;
use App\DB\Connection;
use PDO;

class Cleck{

    public function selectRecent($user_id, $offset = 0){
        try{
            $con = new Connection();

            $sql = "SELECT cleck.*, user.name as user_name, user.username FROM 
            cleck INNER JOIN user ON cleck.user_id = user.id
            INNER JOIN following ON cleck.user_id = following.followed_id
            WHERE following.user_id = :u
            UNION
            SELECT cleck.*, user.name as user_name, user.username FROM
            cleck INNER JOIN user ON cleck.user_id = user.id WHERE cleck.user_id = :u
            ORDER BY timestamp DESC, id DESC
            LIMIT 10 OFFSET :o";

            $ps = $con->getDB()->prepare($sql);
            $ps->bindParam("u", $user_id);
            $ps->bindParam("o", $offset, PDO::PARAM_INT);

            if($ps->execute()){
                $con->close();
                return $ps->fetchAll(PDO::FETCH_OBJ);
            }else{
                $con->close();
                return null;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (selectRecent@Cleck): {$e->getMessage()}");
        }
    }

    public function insert($text, $image, $user_id){
        try{
            $con = new Connection();
            $sql = "INSERT INTO cleck (text, image, user_id) VALUES (:t, :img, :u);";
            $ps = $con->getDB()->prepare($sql);

            $ps->bindParam("t", $text);
            $ps->bindParam("img", $image);
            $ps->bindParam("u", $user_id, PDO::PARAM_INT);

            if($ps->execute()){
                $con->close();
                return true;
            }else{
                $con->close();
                return false;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (insert@Cleck): {$e->getMessage()}");
        }
    }

}