<?php

  class Article
  { private $id_article;
    private $id_client;
    private $id_theme;
    private $titre;
    private $contenu;
    private $tags;
    private $date_publication;

     
  //   public function __construct($id_article,  $id_client,  $id_theme, $titre,  $contenu, $tags,$date_publication)
  // {  $this->id_article = $id_article;
  //    $this->id_client =  $id_client;
  //    $this->id_theme =  $id_theme;
  //    $this->titre = $titre;
  //    $this->contenu =  $contenu;
  //    $this->tags = $tags;
  //    $this->date_publication = $date_publication;

  // } 

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
    
   public static function listerParTheme($pdo, $id_theme)
   {   $query = 'SELECT a.*, t.titre
       FROM themes t
       INNER JOIN articles a ON t.id_theme = a.id_theme WHERE a.id_theme=:id';
       $stmt = $pdo->prepare($query);
       $stmt->execute([":id"=>$id_theme]);
       
       $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
      //  $articles = [];

      //  foreach($result as $row){
      //   $article = new Article(
      //     $row["id_article"], 
      //     $row["id_client"], 
      //     $row["id_theme"], 
      //     $row["titre"], 
      //     $row["contenu"], 
      //     $row["tags"], 
      //     $row["date_publication"]);

      //     $articles[] = $article;
      //  }

      //  return $articles;
    return $result;
     
   }
    
   public static function trouverParId($pdo, $id_article)
   {   $sql = 'SELECT * FROM articles WHERE id_article = ?';
       $stmt = $pdo->prepare($sql);
       $stmt->execute([$id_article]);

       $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
      //  $artis = [];
      //  foreach($resultat as $row){
      //     $arti = new Article(
      //         $row["id_article"], 
      //         $row["id_client"], 
      //         $row["id_theme"], 
      //         $row["titre"], 
      //         $row["contenu"], 
      //         $row["tags"], 
      //         $row["date_publication"]);

      //         $artis[] = $arti;
      //  }
      //  return $artis;
    return $stmt->fetch();
   }

  public static function rechercherParTitre($pdo, $motCle, $id_theme)
  {  $sql = "SELECT * FROM articles  WHERE titre LIKE ? AND id_theme = ?";
     $stmt= $pdo->prepare($sql);
     $like = '%'.$motCle.'%';
     $stmt->execute([$like, $id_theme]);

     return $stmt->fetchAll(PDO::FETCH_CLASS, "Article");
  }

    public function create($pdo)
    { $sql = 'INSERT INTO articles( id_theme, titre, contenu) VALUES (:id_theme, :titre, :contenu)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ':id_theme' => $this->getIdTheme(),
          ':titre' => $this->getTitre(),
          ':contenu' => $this->getContenu()
          

        ]);

    }







  }
  



?>