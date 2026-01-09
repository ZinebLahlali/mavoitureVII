<?php
session_start();
require_once './classes/database.php';
   

$db = new Database();
$pdo = $db->getPdo();

if(isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: Home.php");
        exit;
    }

    $_SESSION['id'] = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if ($user && password_verify($password, $user['password_hash'])) {

        $_SESSION['id'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        

        if ($user['role'] === "admin") {
            header("Location: dash_admin.php");
          
        } else {
            header("Location: index.php");
        }
        exit;
    }
}
