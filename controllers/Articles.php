<?php
use App\Controller;
use App\Model; 
class Articles extends Controller{

    public function index()
    {
        $this->loadModel("Article");
        $articles = $this->Article->getAll();
        $this->render('index', compact('articles'));
    }

    public function lire($slug)
    {
       $this->loadModel("Article");
       $article = $this->Article->findBySlug($slug);
       $this->render('lire', compact('article'));
    }

    public function add()
    {
        $this->loadModel("Article");
        $this->render('add');
    }

}