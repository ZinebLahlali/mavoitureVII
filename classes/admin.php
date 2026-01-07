<?php
 require_once "user.php"


 class Admin extends User
 {    protected $role;  

    public function __construct($id_user, $nom, $prenom, $email,$password, $role)
    {
         parent::__construct($id_user, $nom, $prenom, $email,$password);
         $this->role = $role;
    }     

    //getters

    public function getRole()
    {
        return $this->role;
    }

    //setters
    public function setRole($role)
    {
        $this->role = $role;
    }
    
 }

?>