<?php

namespace App;
use PDO;
abstract class Model {

    private $host = "localhost";
    private $db_name = "mvc";
    private $username = "root";
    private $password = "";
    public $salt ="dgejyenn4kujpoljelnng2nehfdnrrgsm7md47jsdjdsnngggj";

    protected $_connexion;

    public $table;
    public $id;

    public function getConnection(){
        $this->_connexion = null;
        try{
            $this->_connexion = new PDO('mysql:host='. $this->host .'; 
            dbname='. $this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        }catch(PDOException $exception){
            echo 'Erreur: '. $exception->getMessage();
        }
    }

    public function getAll(){
        $sql = "SELECT * FROM ". $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

  
    public function getOne(){
        $sql = "SELECT * FROM ". $this->table. " WHERE id=".$this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getOneBy(string $str, $val){
        $sql = "SELECT * FROM ". $this->table. " WHERE ". $str . " = '".$val."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

}