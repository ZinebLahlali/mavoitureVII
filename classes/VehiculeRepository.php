<?php

    class VehiculeRepository     
{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function listerPagine(int $limit,  int $offset=0)
    {
                $sql = 'SELECT * FROM vehicules
                    ORDER BY marque
                    LIMIT :limit OFFSET :offset';
            $stmt = $this->pdo->prepare($sql);  
            $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();

            $cars = []; 

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $cars[] = new Vehicule(
                $row['id_car'],    
                $row['modele'],
                $row['prix'], 
                $row['disponible'],
                $row['carburant'],
                $row['boit_vitesse'],
                $row['nb_places'],
                $row['marque'], 
                $row['bagages'],
                $row['image']
            );
            }   
            return $cars;  
    
        }


        public function filtrerParCategorie($NomCategories)
{   $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT *, categories.nom as categorie 
    FROM vehicules 
    LEFT JOIN categories ON vehicules.id_cate = categories.id_C
    WHERE  categories.nom LIKE ? ';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$NomCategories]);
    return $stmt->fetchALL();

}

public static function searchParModel($search)
{       $db = new Database();
       $pdo = $db->getPdo();
       $stmt = $pdo->prepare("SELECT *, categories.nom AS categorie
            FROM vehicules
            LEFT JOIN categories ON vehicules.id_cate = categories.id_C WHERE  modele LIKE ?");
            $stmt->execute([$search]);
            $result = $stmt->fetchAll(); 


} 

public function  countVehicules(): int 
{   $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT COUNT(*) AS total
    FROM vehicules';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}

public function  countCategories(): int 
{   $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT COUNT(*) AS total
    FROM categories';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}

public function  countUsers(): int 
{   $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT COUNT(*) AS total
    FROM clients
    WHERE role = "client"';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}

public function  countReservation(): int 
{   $db = new Database();
    $pdo = $db->getPdo();

    $sql = 'SELECT COUNT(*) AS total
    FROM reservations';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}
















}








?>