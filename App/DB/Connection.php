<?php

namespace App\DB;
use PDO;

class Connection{
    private $db;

    function __construct(){
        try{
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->db = new PDO($dsn, DB_USER, DB_PWD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die("[-] Erro na conexão com o BD (PDOException): {$e->getmessage()}");
        }catch(Exception $e){
            die("[-] Erro geral na conexão com o BD: {$e->getmessage()}");
        }
    }

    public function getDB(){
        return $this->db;
    }

    public function close(){
        $this->db = null;
    }
}