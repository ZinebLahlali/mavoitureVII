<?php
   session_start();
   require_once 'database.php';
   require_once "./classes/Client.php";
      $db = new Database();
      $pdo = $db->getPdo();

  $c = new Client();



   if(isset($_POST['register'])){
      $c->setNom(htmlspecialchars(trim($_POST['nom'])));
      $c->setPrenom(htmlspecialchars(trim($_POST['prenom'])));
      $c->setEmail(trim($_POST['email']));
      $c->setPassword(htmlspecialchars(trim($_POST['password'])));
      $confirm = htmlspecialchars($_POST['confirm']);
      $c->setMobile(htmlspecialchars(trim($_POST['mobile'])));
      $c->setAdresse(htmlspecialchars(trim($_POST['adresse'])));
      $c->setVille(htmlspecialchars(trim($_POST['ville'])));
        

     if(!empty($c->getNom())&&!empty($c->getPrenom())&&!empty($c->getEmail())&&!empty($c->getPassword())&&!empty($c->getMobile())&&!empty($c->getAdresse())&&!empty($c->getVille())){
            if($c->getPassword() !== $confirm){
                $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
                exit;
            } 
                //vérifie si l'utilisateur exite déja
                $check = $pdo->prepare("SELECT * FROM client WHERE email = ?");
                $check->execute([$c->getEmail()]);
                if ($check->rowCount() > 0) {
                    $_SESSION['error'] = "Ce email déjà utilisé.";
                    exit;
                } 
                //mote de passe hash
                $hashed = password_hash($c->getPassword(), PASSWORD_DEFAULT);
                $c->setPassword($hashed);

                $c->creer();
                header('location: profil.php');
                exit;

    } else {
         $_SESSION['error'] = "Tous les champs sont requis.";
    }

}








?>