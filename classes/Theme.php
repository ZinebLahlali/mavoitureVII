<?php
require_once './classes/database.php';
class Theme
{  private $id_theme;
   private $titre;
   private $description;
   private $actif;


 public function __construct($id_theme = '', $titre = '', $description = '', $actif = '')
 {  $this->id_theme = $id_theme;
    $this->titre = $titre;
    $this->description = $description;
    $this->actif = $actif;

 }

 //getters toujour return a //value// 

 public function getIdTheme()
 {
        return $this->id_theme;
 }

 public function getTitre()
 {
    return $this->titre;
 }
  public function getDescription()
 {
    return $this->description;
 }
  public function getActif()
 {
    return $this->actif;
 }


 //Setters

 public function setIdTheme($id_theme)
 {
    $this->id_theme = $id_theme;
 }


  public function setTitre($titre)
 {
    $this->titre = $titre;
 }

  public function setDescription($description)
 {
    $this->description = $description;
 }

  public function setActif($actif)
 {
    $this->actif = $actif;
 }


 public static function listerTousActifs($pdo)
 { 

    $query = 'SELECT * FROM themes 
    WHERE actif = 0';
    $stmt = $pdo->preapre($query);
    $stmt->execute();

    $resulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($resulta as $row){
        $theme = new Theme($row["id"], $row["titre"], $row["description"], $row["actif"])
        $themes[] = $theme;
    }
    return $themes;
    
 }






}




?>