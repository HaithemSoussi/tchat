<?php

use App\Controller;
use App\Model; 


class Home extends Controller{

    public function index()
    {     
       $this->loadModel("User");
        extract($_POST);
        $user = new User();
        if(isset($send))
        {

            $find = $this->User->getOneBy('email', $email);
            if(empty($find)){
            $user->setEmail($email);
            $user->setPassword($password);
            $id=$user->add($user);
            session_start(); 
            session_regenerate_id(true);
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            echo "Records Saved ";
            header('location:../users/edit/'. $id);
            }else{
             $ger= $user->login($email, $password);
             if(!empty($ger)){
                session_start(); 
                session_regenerate_id(true);
                $_SESSION['id'] = $ger['id'];
                $_SESSION['email'] = $ger['email'];
                $_SESSION['pseudo'] = $ger['pseudo'];
                $_SESSION['nom'] = $ger['nom'];
                $_SESSION['prenom'] = $ger['prenom'];
                header('location:../users/index/'. $ger['id']);
                 
             }else{
                echo 'Mauvais mot de passe';
                //header('location:../home/index');
             }
           
            }
            
        }
        
        $this->render('index');
        
    }

   

}