<?php

require_once("./classes/Avis.php");
require_once("./classes/Database.php");



if(isset($_POST["avis"])){
      $id_car = $_GET['id'];
      $id_client = $_SESSION['id'];
      $note = $_POST['note'] ?? '';
      $commentaire = $_POST['commentaire'] ?? '';
      
      $av = new Avis();
      $av->setIdClient($id_client);
      $av->setIdVehicule($id_car);
      $av->setNote($note);
      $av->setComment($commentaire);

      $av->AddComment();


  }
