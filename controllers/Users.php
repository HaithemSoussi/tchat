<?php

use App\Controller;
use App\Model; 

class Users extends Controller{

    public function index($id)
    {
        $this->loadModel("User");
        extract($_POST);
        if(isset($sender)){
        $user = new User();  
        $listes = $user->search($mot,$id);
        $this->render('index', compact('listes'));
        }else{
        $user = new User();
        $ps = $user->getMyPseudo($id);
        $this->loadModel("Groupe");
        $groupe = new Groupe(); 
        $groupeids = $this->Groupe->getAllId($ps['pseudo']);
        foreach ($groupeids as $groupeid){
            $groupePseudos = $this->Groupe->getAllPseudo($groupeid['id'],$ps['pseudo']);
            foreach($groupePseudos as $groupePseudo){
                $listeAmis[]=array(
                    'id'=>$groupePseudo['id'],
                    'pseudo'=>$groupePseudo['pseudo']
                );
            }
        }
        extract($_POST);
        var_dump($_POST);
        if(isset($send)){

            $message = $message.''.$id;
         //  var_dump($message);
          /*var_dump("$message$id");
          var_dump($senderpseudo = $ps['pseudo']);*/
           /*$groupe_id = 1;*/
        }
        $this->render('index', compact('listeAmis'));
        }
        
    }
    public function edit($id)
    {
        $this->loadModel("User");
        extract($_POST);
        if(isset($edit)){
            $user = new User();
            $user->setId($id);
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setPseudo($pseudo);
            $user->edit($user);
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['pseudo'] = $pseudo;
            echo 'Updated';
        }
       
        $this->render('edit');
 
    }

    public function logout()
    {
       session_start(); 
       session_unset();
       session_destroy();
       header('location:../home/index');
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    public function generateFormHash($salt)
    {
        $hash = md5(mt_rand(1,1000000) . $salt);
        $_SESSION['csrf_hash'] = $hash;
        return $hash;
    }

    public function isValidFormHash($hash)
    {
        return $_SESSION['csrf_hash'] === $hash;
    }
}