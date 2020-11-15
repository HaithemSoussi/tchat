<?php 

use App\Model; 

class Article extends Model{
    public $id;
    public $nom;
    public $slug;
    public $description;    
    public $prix;

    public function __construct(){
        $this->table = "articles";
        $this->getConnection();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        return  $this->nom=$nom;
    }

    public function getSlug(){
        return $this->slug;
    }
    
    public function setSlug($slug){
        return  $this->slug= $slug;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function setDescription($description) {
        return  $this->description = $description;
    }
    
    public function getPrix(){
        return $this->prix;
    }
    public function setPrix($prix){
        return $this->prix = $prix;
    }
    public function findBySlug(string $slug){
        $sql = "SELECT * FROM ". $this->table. " WHERE slug='".$slug."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    
    private static function slugify($text)
    {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
    }

    public function add(Article $article)
    {
      $slug=Article::slugify($article->getNom());
      $sql ='INSERT INTO articles (nom, slug, description, prix) VALUES(:nom, :slug, :description, :prix)';
      $query= $this->_connexion->prepare($sql);
      $article->setSlug = $article->getNom();
      $query->bindValue(':nom', $article->getNom());
      $query->bindValue(':slug', $slug);
      $query->bindValue(':description', $article->getDescription());
      $query->bindValue(':prix', $article->getPrix());
      $query->execute();
   
    }

}