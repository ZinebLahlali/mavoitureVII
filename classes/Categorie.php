<?php
      

      class Categorie 
      { private $id_cate;
        private $nom;
        private $descreption;


        public function __construct($id_cate, $nom, $descreption)
        {    $this->id_cate = $id_cate;
             $this->nom = $nom;
             $this->descreption = $descreption;
        }


        //getters

        public function getId()
        {
            return $this->id_cate;
        }

        public function getNom()
        {
             return $this->nom;
        }

        public function getDescreption()
        {  
            return $this->descreption;
        }


        //setters
        public function setId($id_cate)
        {  
           $this->id_cate = $id_cate;
        }

        public function detNom($nom)
        {
            $this->nom = $nom;
        }

        public function setDescreption($descreption)
        {
            $this->descreption = $descreption;
        }
















      }





?>