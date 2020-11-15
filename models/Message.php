<?php 

use App\Model; 

class Message extends Model{

    public $id;
    public $message;
    public $senderpseud;
    public $group_id;    
  

    public function __construct(){
        $this->table = "message";
        $this->getConnection();
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        return $this->id = $id;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage(string $message){
        return  $this->message = $message;
    }

    public function getSenderpseudo(){
        return $this->senderpseudo;
    }

    public function setSenderpseudo(string $senderpseudo){
        return  $this->senderpseudo = $senderpseudo;
    }

    public function getGroupId(){
        return $this->group_id;
    }

    public function setGroupId(string $group_id){
        return  $this->group_id = $group_id;
    }

    public function add(Message $message)
    {
      
      $sql ='INSERT INTO messages (message, senderpseudo, group_id) VALUES(:message, :senderpseudo, :group_id)';
      $query= $this->_connexion->prepare($sql);
      $query->bindValue(':message', $message->getMessage());
      $query->bindValue(':senderpseudo', $message->getSenderpseudo());
      $query->bindValue(':group_id', $message->getGroupId());
      $query->execute();
      return $this->_connexion->lastInsertId();
      //print_r($query->errorInfo()); 
    }

}