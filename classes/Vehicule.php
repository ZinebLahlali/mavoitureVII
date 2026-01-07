<?php
class Vehicule
{  private $id_car;
   private $modele;
   private $prix;
   private $disponible;
   private $carburant;
   private $boit_vitesse;
   private $nb_places;
   private $marque;
   private $bagages;
   private $image;



public function __construct($id_car, $modele, $prix, $disponible, $carburant,$boit_vitesse, $nb_places, $marque, $bagages, $image){
         $this->id_car = $id_car;
         $this->modele = $modele;
         $this->prix = $prix;
         $this->disponible = $disponible;
         $this->carburant = $carburant;
         $this->boit_vitesse = $boit_vitesse;
         $this->nb_places = $nb_places;
         $this->marque = $marque;
         $this->bagages = $bagages;
         $this->image = $image;

} 

//getters

public function getId(){
    return $this->id;
}
public function getModele(){
    return $this->modele;
}
public function getPrix(){
    return $this->prix;
}
public function getDisponible(){
    return $this->disponible;
}
public function getCarburant(){
    return $this->carburant;
}
public function getBoite(){
    return $this->boit_vitesse;
}

public function getNbPlaces(){
    return $this->nb_places;
}
public function getMarque(){
    return $this->marque;
}
public function getBagages(){
    return $this->bagages;
}
public function getImage(){
    return $this->image;
}


//sterres
public function setId($id_car){
    $this->id_car = $id_car;
}
public function setModele($modele){
    $this->modele = $modele;
}
public function setPrix($prix){
    $this->prix  = $prix;
}
public function setDisponible($disponible){
    $this->disponible = $disponible;
}
public function setCarburant($carburant){
    $this->carburant = $carburant;
}
public function setBoite($boite_vitesse){
    $this->boit_vitesse = $boit_vitesse;
}
public function setNbPlaces($nb_places){
    $this->nb_places = $nb_places;
}
public function setMarque($marque){
    $this->marque = $marque;
}
public function setBagages($bagages){
    $this->bagages = $bagages;
}
public function setImage($image){
    $this->image = $image;
}


public static function listerTous()
{     $db = new Database();
      $pdo = $db->getPdo();

    $sql = "SELECT *, categories.nom AS categorie
    FROM vehicules
    LEFT JOIN categories ON vehicules.id_cate = categories.id_C";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


public static function getById($id_car)
{     $db = new Database();
      $pdo = $db->getPdo();

    $sql = "SELECT *, categories.nom AS categorie
    FROM vehicules
    LEFT JOIN categories ON vehicules.id_cate = categories.id_C WHERE id_car = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_car]);

    //   $stmt->setFetchMode(PDO::FETCH_CLASS, 'Vehicule');
     return $stmt->fetch();
}



















}


?>

