<?php
require_once './classes/database.php';


  class Article
  { private $id_article;
    private $id_client;
    private $id_theme;
    private $titre;
    private $contenu;
    private $tags;
    private $date_publication;

     
    public function __construct($id_article,  $id_client,  $id_theme, $titre,  $contenu, $tags,$date_publication)
  {  $this->id_article = $id_article;
     $this->id_client =  $id_client;
     $this->id_theme =  $id_theme;
     $this->titre = $titre;
     $this->contenu =  $contenu;
     $this->tags = $tags;
     $this->date_publication = $date_publication;

  } 

   //getters toujour return a //value//
  public function getIdArticle()
  {
    return $this->id_article;
  }

   public function getIdClient()
  {
    return $this->id_client;
  }

   public function getIdTheme()
  {
    return $this->id_theme;
  }

   public function getTitre()
  {
    return $this->titre;
  }

   public function getContenu()
  {
    return $this->contenu;
  }

   public function getTags()
  {
    return $this->tags;
  }

   public function getDatePublication()
  {
    return $this->date_publication;
  }

  
   //Setters

   public function setIdArticle($id_article)
   {
     $this->id_article = $id_article;
   }

    public function setIdClient($id_client)
   {
     $this->id_client = $id_client;
   }
    public function setIdtheme($id_theme)
   {
     $this->id_theme = $id_theme;
   }
    public function setTitre($titre)
   {
     $this->titre = $titre;
   }
    public function setContenu($contenu)
   {
     $this->contenu = $contenu;
   }
    public function setTags($tags)
   {
     $this->tags = $tags;
   }

    public function setDatePublication($date_publication)
   {
     $this->date_publication = $date_publication;
   }
    
   public function listerParTheme($pdo, $idTheme)






  }
  



?>