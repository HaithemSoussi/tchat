<?php 

use App\Model; 

class User extends Model{

    public $id;
    public $nom;
    public $prenom;
    public $pseudo;    
    public $password;
    public $email;

    public function __construct(){
        $this->table = "users";
        $this->getConnection();
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        return $this->id = $id;
    }

    public function getNom(){
        return $this->nom;
    }
    
    public function setNom(string $nom){
        return  $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }
    
    public function setPrenom(string $prenom){
        return  $this->prenom = $prenom;
    }

    public function getPseudo(){
        return $this->pseudo;
    }
    
    public function setPseudo(string $pseudo){
        return  $this->pseudo=$pseudo;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword(string $password){
        return  $this->password= MD5($password);
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail(string $email){
        return  $this->email= $email;
    }
    

    public function add(User $user)
    {
      
      $sql ='INSERT INTO users (email, password) VALUES(:email, :password)';
      $query= $this->_connexion->prepare($sql);
      $query->bindValue(':email', $user->getEmail());
      $query->bindValue(':password', $user->getPassword());
      $query->execute();
      return $this->_connexion->lastInsertId();
      //print_r($query->errorInfo()); 
    }
    
    public function search(string $mot, int $id){
        $sql = "SELECT * FROM users WHERE id != :id AND (pseudo LIKE :pseudo OR email LIKE :email 
        OR nom LIKE :nom OR prenom LIKE :prenom) ";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':email', "%".$mot."%");
        $query->bindValue(':pseudo', "%".$mot."%");
        $query->bindValue(':nom', "%".$mot."%");
        $query->bindValue(':prenom', "%".$mot."%");
        $query->execute();
        return $query->fetchAll();
    }

    public function edit(User $user)
    {
      $sql = "UPDATE users SET nom = :nom, prenom = :prenom, pseudo = :pseudo WHERE id = :id";
      $query= $this->_connexion->prepare($sql);
      $query->bindValue(':nom', $user->getNom());
      $query->bindValue(':prenom', $user->getPrenom());
      $query->bindValue(':pseudo', $user->getPseudo());
      $query->bindValue(':id', $user->getId());
      $query->execute();
      
      //print_r($query->errorInfo()); 
      
    }

    public function login($email, $password){
        $sql = "SELECT * FROM users WHERE email='".$email."' AND password=MD5('".$password."')";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getAllsaufId($id){
        $sql = "SELECT * FROM users WHERE id !=".$id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
         //print_r($query->errorInfo()); 
    }
    
    public function getMyPseudo($id) {
        $sql="SELECT * FROM users WHERE id = :id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $ids= $query->fetch();
        return $ids;
    }

    public function listeAmis($pseudo) {
       $sql = "SELECT id FROM groupes WHERE pseudo = :pseudo";
       $query = $this->_connexion->prepare($sql);
       $query->bindValue(':pseudo', $pseudo);
       $query->execute();
       $res = $query->fetchAll();
       foreach ($res as $re){
        $sql2 = "SELECT * FROM groupes WHERE id = :id and pseudo != :pseudo";
        $query2 = $this->_connexion->prepare($sql2);
        $query2->bindValue(':id',  $re['id']);
        $query2->bindValue(':pseudo', $pseudo);
        $query2->execute();
        $dd[] = $query2->fetchAll();
       }
     
        return $dd ;
    }
    /*public function add(User $user)
    {
      $sql ='INSERT INTO users (nom, prenom, password, pseudo, email) VALUES(:nom, :prenom, :password, :pseudo, :email)';
      $query= $this->_connexion->prepare($sql);
      $query->bindValue(':nom', $user->getNom());
      $query->bindValue(':prenom', $user->getPrenom());
      $query->bindValue(':password', $user->getPassword());
      $query->bindValue(':pseudo', $user->getPseudo());
      $query->bindValue(':email', $user->getEmail());
      $query->execute();
   
    }*/
    
}