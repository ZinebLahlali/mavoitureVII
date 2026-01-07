<?php

class Avis
{  private $id_avi;
   private $note;
   private $commentaire;
   private $soft_deleted;
   private $date_avis;
   private $id_client;
   private $id_vehicule;


        //getters
        public function getId(){
            return $this->id_avi;
        }
        public function getNot(){
            return $this->note;
        }
        public function getComment(){
            return $this->commentaire;
        }
        public function getSoftDeleted(){
            return $this->soft_deleted;
        }
        public function getDateAvis(){
            return $this->date_avis;
        }
         public function getIdClient(){
            return $this->id_client;
        }
         public function getIdVehicule(){
            return $this->id_vehicule;
        }

        //setters
        public function setId($id_avi){
            $this->id_avi = $id_avi;
        }
        public function setNote($note){
            $this->note =  $note;
        }
        public function setComment($commentaire){
            $this->commentaire = $commentaire;
        }
        public function setSoftDeleted($soft_deleted){
            $this->soft_deleted= $soft_deleted;
        }
        public function setDateAvis($date_avis){
            $this->date_avis;
        }
         public function setIdClient($id_client){
            $this->id_client;;
        }
         public function setIdVehicule($id_vehicule){
            $this->id_vehicule;
        }


       public function AddComment()
       { 
         $db = new Database();
          $pdo = $db->getPdo();

          $sql = 'INSERT INTO avis(note, commentaire, soft_deleted, date_avis, id_client, id_vehicule) VALUES (?,?,?,?,?,?)';
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
                    $this->note,
                    $this->commentaire,
                    $this->soft_delete = 0, 
                    $this->date_avis = date('Y-m-d H:i:s'),

                    $this->id_client,
                    $this->id_vehicule 

                    
          ]);

        


       }

    //    public function showCommentaireByCar()
    //    {
    //         $query = "SELECT * FROM avis WHERE id_vehicle"
    //    }


    //    public function modifyComment()
    //    {  $db = new Database();
    //       $pdo = $db->getPdo();

    //       $sql = 'SELECT * FROM'

    //    }



}



?>