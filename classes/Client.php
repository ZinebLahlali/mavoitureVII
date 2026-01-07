<?php
require_once "user.php"

class Client extends User 
{  protected $mobile;
   protected $adresse;
   protected $ville

   public function __construct($id_user, $nom, $prenom, $email,$password_hash, $mobile, $adresse, $ville)
   {  parent::__construct($id_user, $nom, $prenom, $email,$password_hash);
      $this->mobile = $mobile;
      $this->adresse = $adresse;
      $this->ville = $ville;
   }

   //getters toujour return a //value// 
   public function getMobile()
   {
        return $this->mobile;
   }

   public function getAdresse()
   {
     return $this->adresse;
   }

   public function getVille()
   {
     return $this->ville;
   }

   //setter pour mettre à jour

   public function setMobile($mobile)
   {
      $this->mobile = $mobile;
   }
   public function setAdresse($adresse)
   {
      $this->adresse = $adresse;
   }

   public function setVille($ville)
   {
      $this->ville = $ville;
   }


   public function cree()
   { 
     $sql = "INSERT INTO clients (nom, prenom, email, password_hash, mobile, adresse, ville) VALUES (?, ?, ?, ?, ?, ?, ?)";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([
        $nom,
        $prenom,
        $email,
        $password,
        $mobile,
        $adresse,
        $ville
     ]);

   }




}




?>