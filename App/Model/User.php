<?php

namespace App\Model;
use App\DB\Connection;
use PDO;

class User{

    public function select($email){
        try{
            $con = new Connection();
            $sql = "SELECT * FROM user WHERE email=:e;";
            $ps = $con->getDB()->prepare($sql);
            $ps->bindParam("e", $email);
            $ps->setFetchMode(PDO::FETCH_OBJ);
            if($ps->execute()){
                $con->close();
                return $ps->fetch();
            }else{
                $con->close();
                return null;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (select@User): {$e->getMessage()}");
        }
    }

    public function selectAll(){
        try{
            $con = new Connection();
            $sql = "SELECT * FROM user;";
            $ps = $con->getDB()->prepare($sql);
            $ps->setFetchMode(PDO::FETCH_OBJ);
            if($ps->execute()){
                $con->close();
                return $ps->fetchAll();
            }else{
                $con->close();
                return null;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (selectAll@User): {$e->getMessage()}");
        }
    }

    public function insert($name, $username, $email, $birth_date, $gender, $pwd_hash){
        try{
            $con = new Connection();
            $sql = "INSERT INTO user (name, username, email, birth_date, gender, pwd_hash) VALUES (:n, :nn, :e, :b, :g, :ph)";
            $ps = $con->getDB()->prepare($sql);

            $ps->bindParam("n", $name);
            $ps->bindParam("nn", $username);
            $ps->bindParam("e", $email);
            $ps->bindParam("b", $birth_date);
            $ps->bindParam("g", $gender);
            $ps->bindParam("ph", $pwd_hash);

            if($ps->execute()){
                $con->close();
                return true;
            }else{
                $con->close();
                return false;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (insert@User): {$e->getMessage()}");
        }
    }

    public function validateLogin(){
        if(isset($_POST["email"], $_POST["pwd"])){
            $user = $this->select($_POST["email"]);
            if($user != null && password_verify($_POST["pwd"], $user->pwd_hash)){
                return array(
                    "status" => true,
                    "msg" => "Logado com sucesso!",
                    "user" => $user
                );
            }else{
                return array(
                    "status" => false,
                    "msg" => "Usuário ou senha incorretos!"
                );
            }
        }else{
            return array(
                "status" => false,
                "msg" => "Campos vazios!"
            );
        }
    }
}