<?php

namespace App\Model;
use App\DB\Connection;
use PDO;

class User{

    public function selectByEmail($email){
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

    public function selectByUsername($username){
        try{
            $con = new Connection();
            $sql = "SELECT * FROM user WHERE username=:u;";
            $ps = $con->getDB()->prepare($sql);
            $ps->bindParam("u", $username);
            $ps->setFetchMode(PDO::FETCH_OBJ);
            if($ps->execute()){
                $con->close();
                return $ps->fetch();
            }else{
                $con->close();
                return null;
            }
        }catch(PDOException $e){
            die("[-] Erro na execução da query (selectByUsername@User): {$e->getMessage()}");
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

    public function insert($user){
        try{
            $con = new Connection();
            $sql = "INSERT INTO user (name, username, email, birth_date, gender, pwd_hash) VALUES (:n, :nn, :e, :b, :g, :ph)";
            $ps = $con->getDB()->prepare($sql);

            $ps->bindParam("n", $user["name"]);
            $ps->bindParam("nn", $user["username"]);
            $ps->bindParam("e", $user["email"]);
            $ps->bindParam("b", $user["birth_date"]);
            $ps->bindParam("g", $user["gender"]);
            $ps->bindParam("ph", $user["pwd_hash"]);

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
            $user = $this->selectByEmail($_POST["email"]);
            if($user != null && password_verify($_POST["pwd"], $user->pwd_hash)){
                return array(
                    "status" => true,
                    "msg" => "Logado com sucesso!",
                    "user" => $user
                );
            }else{
                return array(
                    "status" => false,
                    "msg" => "Email ou senha incorretos!"
                );
            }
        }else{
            return array(
                "status" => false,
                "msg" => "Campos vazios!"
            );
        }
    }

    public function validateAndDoSignup(){
        if(isset($_POST["name"], $_POST["username"], $_POST["email"], $_POST["birth_date"], $_POST["gender"], $_POST["pwd"])){
            if($this->selectByEmail($_POST["email"]) != null){
                return array(
                    "status" => false,
                    "msg" => "Esse email já está cadastrado!"
                );
            }else if($this->selectByUsername($_POST["username"]) != null){
                return array(
                    "status" => false,
                    "msg" => "Esse nome de usuário já está cadastrado!"
                );
            }else{
                $_POST["pwd_hash"] = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
                unset($_POST["pwd"]);

                if($this->insert($_POST)){
                    return array(
                        "status" => true,
                        "msg" => "Cadastro concluído com sucesso!"
                    );
                }else{
                    return array(
                        "status" => false,
                        "msg" => "Erro ao cadastrar!"
                    );
                }
            }
        }else{
            return array(
                "status" => false,
                "msg" => "Preencha todos os campos!"
            );
        }
    }
}