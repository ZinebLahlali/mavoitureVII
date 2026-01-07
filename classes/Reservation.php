<?php
class Reservation 
{  private $id_res;
   private $date_debut;
   private $date_fin;
   private $lieu_depart;
   private $lieu_retour;
   private $statut;
   private $id_client;
   private $id_vehicule;

   public function __construct($id_res = '', $id_client= '', $id_vehicule = '', $date_debut = '', $date_fin = '', $lieu_depart = '', $lieu_retour ='', $statut = 'available'){
        $this->id_res = $id_res;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu_depart = $lieu_depart;
        $this->lieu_retour = $lieu_retour;
        $this->statut = $statut;
        $this->id_client = $id_client;
        $this->id_vehicule = $id_vehicule;

         
   }

   //getters

public function getId(){
    return $this->id_res;
}
public function getDatedebut(){
    return $this->date_debut;
}
public function getDatefin(){
    return $this->date_fin;
}
public function getLieuD(){
    return $this->lieu_depart;
}
public function getLieuR(){
    return $this->lieu_retour;
}
public function getStatut(){
    return $this->statut;
}
public function getclient(){
    return $this->id_client;
}
public function getVehicule(){
    return $this->id_vehicule;
}


//setters
public function setId($id_res){
    $this->id_res = $id_res;
}
public function setDatedebut($date_debut){
    $this->date_debut =  $date_debut;
}
public function setDatefin($date_fin){
    $this->date_fin = $date_fin;
}
public function setLieuD($lieu_depart){
    $this->lieu_depart = $lieu_depart;
}
public function setlieuR($lieu_retour){
    $this->lieu_retour = $lieu_retour;
}
public function setStatut($statut){
    $this->statut= $statut;
}
public function setClient($id_client){
    $this->id_client= $id_client;
}
public function setVehicule($id_vehicule){
    $this->id_vehicule= $id_vehicule;
}
 
   public function creer()
   {   $db = new Database();
       $pdo = $db->getPdo();

       $sql = 'INSERT INTO reservations(id_client, id_vehicule, date_debut,date_fin,lieu_depart, lieu_retour, statut) VALUES (?,?,?,?,?,?,?)';
       $stmt = $pdo->prepare($sql);
       $stmt->execute([
            $this->id_client,
            $this->id_vehicule,
            $this->date_debut,
            $this->date_fin,
            $this->lieu_depart,
            $this->lieu_retour,
            $this->statut
       ]);
   }

  public function isDisponible($id_car, $dateDebut, $dateFin)
  { $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT * FROM reservations WHERE id_vehicule= ? AND date_debut <= ? AND date_fin >= ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_car,$dateDebut, $dateFin]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? false : true;
  }

 

}
?>
