<?php

  class Commentaire
{               private $id_com;
                private $id_client;
                private $id_article;
                private $contenu;
                private $date_commentaire;
                private $soft_deleted;



             //getters

            public function getIdCom()
            {
                return $this->id_com;
            }

            public function getIdClient()
            {
                return $this->id_client;
            }

            public function getIdArticle()
            {
                return $this->id_article;
            }

            public function getContenu()
            {
                return $this->contenu;
            }

            public function getDateCommentaire()
            {
                return $this->date_commentaire;
            }

            public function getSoftDeleted()
            {
                return $this->soft_deleted;
            }


            //setters

            public function setIdCom($id_com)
            {
                $this->id_com = $id_com;
            }

            public function setIdClient($id_client)
            {
                $this->id_client = $id_client;
            }
            public function setIdArticle($id_article)
            {
                $this->id_article = $id_article;
            }
            public function setContenu($contenu)
            {
                $this->contenu = $contenu;
            }
            public function setDateCommentaire($date_commentaire)
            {
                $this->date_commentaire = $date_commentaire;
            }
            public function setSoftDeleted($soft_deleted)
            {
                $this->soft_deleted = $soft_deleted;
            }


            public static function listerParArticle($pdo,$id_article)
             {   $sql = 'SELECT c.*, a.titre 
                  FROM articles a
                  inner JOIN commentaires c ON c.id_article = a.id_article WHERE a.id_article = :id';
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute([":id"=>$id_article]);

                  $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Commentaire');


                  return $result;


             }


              
             
             
       public function create($pdo)
            { $sql = 'INSERT INTO commentaires(contenu, date_commentaire) VALUES (:contenu, :date_commentaire)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                ':contenu' => $this->getContenu(),
                ':date_commentaire' => $this->getDateCommentaire()
                ]);

            }



  }
   










  



?>
