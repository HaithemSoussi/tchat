<?php 
use App\Controller;
use App\Model; 

class Groupes extends Controller{

    public function index($id)
    {
    }

    private function searchLastID () {
        $this->loadModel("Groupe");
    }

    public function add($mypseudo, $pseudo, $user_id)
    {
        $this->loadModel("Groupe");
        $groupe = new Groupe();
        $arr = $groupe->lastMaxId();
        $array_ids = array();
        $my_ids = $groupe->verif($mypseudo);
        $exist = false;
        foreach($my_ids as $my_id){
           $X =  $my_id[0];
           $ids = $groupe->verif2($X, $mypseudo);
           if($ids['pseudo'] == $pseudo){
               $exist= true;
               break;
           }else{
            $exist = false;
           }
        }
    
        if ($exist == false){
        $id= intval($arr[0]) + 1;
        $groupe->add($mypseudo, $id);
        $groupe->add($pseudo, $id);
        }else{
          echo 'groupe existe déja';
        }
      
        header('Location:../../../../users/index/'.$user_id);
    }
}