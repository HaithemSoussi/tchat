<?php 

use App\Model; 

class Groupe extends Model{

    public $id;
    public $pseudo;

    public function __construct(){
        $this->table = "groupes";
        $this->getConnection();
    }
    
    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        return $this->id = $id;
    }

    public function getPseudo(){
        return $this->pseudo;
    }
    
    public function setPseudo(string $pseudo){
        return  $this->pseudo = $pseudo;
    }
    
    public function lastMaxId(){
        $sql = "SELECT max(id) FROM groupes";
        $query= $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function verif($pseudo) {
        $sql = "SELECT id from groupes where pseudo = :pseudo";
        $query= $this->_connexion->prepare($sql);
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        return $query->fetchAll();
    }

    public function verif2($id, $pseudo) {
        $sql = "SELECT * from groupes where id = :id and pseudo != :pseudo ";
        $query= $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        return $query->fetch();
    }

    public function verif1($pseudo, $id) {
        $sql = "SELECT * from groupes where pseudo = :pseudo and id = :id";
        $query= $this->_connexion->prepare($sql);
        $query->bindValue(':pseudo', $pseudo);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function add($pseudo, $id)
    {
      $sql ='INSERT INTO groupes (id, pseudo) VALUES (:id, :pseudo)';
      $query= $this->_connexion->prepare($sql);
      $query->bindValue(':id', $id);
      $query->bindValue(':pseudo', $pseudo);
      $query->execute();
      return $this->_connexion->lastInsertId();
      //print_r($query->errorInfo()); 
    }

    public function getAllId($pseudo){
        $sql = "SELECT id from groupes where pseudo = :pseudo";
        $query= $this->_connexion->prepare($sql);
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        return $query->fetchAll();
    }

    
    public function getAllPseudo($id, $pseudo){
        $sql = "SELECT * from groupes where id = :id AND pseudo != :pseudo";
        $query= $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':pseudo', $pseudo);
        $query->execute();
        return $query->fetchAll();
    }
}