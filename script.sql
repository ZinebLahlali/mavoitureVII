-- Active: 1764688567617@@localhost@3306@phpmyadmin
CREATE DATABASE mabagnole;
 use mabagnole;

 CREATE TABLE clients(
    id_user int AUTO_INCREMENT PRIMARY KEY,
    nom  varchar (50) NOT NULL,
    email varchar (100) NOT NULL,
    prenom varchar (50) NOT NULL,
    password_hash varchar (100) NOT NULL,
    mobile varchar (100) NOT NULL,
    adresse varchar (100) NOT NULL,
    ville varchar (100) NOT NULL
 );

 

  

 CREATE TABLE categories(
    id_C int AUTO_INCREMENT PRIMARY KEY,
    nom varchar (50),
    description varchar (100)

 );
 
 INSERT INTO categories(nom, description) VALUES ("Citadine", "Petite voiture compacte, idéale pour la conduite en ville, facile à garer et économique en carburant.");



CREATE TABLE vehicules(
    id_car int AUTO_INCREMENT PRIMARY KEY,
    modele varchar (50),
    prix int,
    disponible bool,
    carburant bool,
    boit_vitesse varchar (100),
    nombres_places int,
    marque varchar (100),
    image varchar (255),
    bagages int,
    id_cate int,
    FOREIGN KEY (id_cate) REFERENCES categories (id_C)
);




INSERT INTO vehicules(modele,prix,disponible, carburant,  boit_vitesse, nombres_places,marque,image,bagages,id_cate) VALUES
("Polo", "500", "libre", "Essence", "Automatique", "5", "Volkswagen", "https://images.caradisiac.com/logos/8/4/6/4/268464/S8-volkswagen-polo-restylee-laquelle-choisir-192208.jpg", "4","2");


CREATE TABLE reservations(
    id_res int AUTO_INCREMENT PRIMARY KEY,
    id_client int,
    id_vehicule int,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    lieu_depart varchar (100),
    lieu_retour varchar (100),
    statut bool,
    FOREIGN KEY (id_client) REFERENCES clients (id_user),
    FOREIGN KEY (id_vehicule) REFERENCES vehicules (id_car) 
);

CREATE TABLE avis(
   id_avi int AUTO_INCREMENT PRIMARY KEY,
   note int,
   commentaire varchar (255),
   soft_deleted BOOLEAN DEFAULT FALSE,
   date_avis DATE,
   id_client int,
   id_vehicule int ,
    FOREIGN KEY (id_client) REFERENCES clients (id_user),
    FOREIGN KEY (id_vehicule) REFERENCES vehicules (id_car) 

);

ALTER TABLE vehicules 
ADD image varchar (255);

SELECT * FROM vehicules;

SELECT * FROM clients;


SELECT *
FROM clients
ORDER BY id_user DESC
LIMIT 2;

select * FROM categories;

select vehicules.* FROM vehicules 
INNER JOIN categories ON  vehicules.id_cate = categories.id_C
where categories.nom in ('Citadine','Monospace');

SELECT COUNT(*) as total 
FROM vehicules 
inner JOIN categories on vehicules.id_cate = categories.id_C
where categories.nom = "Monospace";


CREATE Table themes(
    id_theme int PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR (50),
    description VARCHAR (255),
    actif BOOLEAN
);

CREATE TABLE articles(
    id_article int,
    id_client int,
    id_theme int,
    titre VARCHAR (50),
    contenu VARCHAR (250),
    tags VARCHAR (250),
    date_publication DATE,
    Foreign Key (id_theme) REFERENCES themes (id_theme),
    Foreign Key (id_client) REFERENCES clients(id_user)
);



ALTER TABLE articles
MODIFY id_article INT NOT NULL AUTO_INCREMENT,
ADD PRIMARY KEY(id_article);

CREATE TABLE commentaires(
    id_com INT PRIMARY KEY AUTO_INCREMENT,
    id_client INT,
    id_article INT,
    contenu VARCHAR (250),
    date_commentaire DATE,
    soft_deleted INT DEFAULT 0,
    FOREIGN KEY (id_client) REFERENCES clients(id_user),
    FOREIGN KEY (id_article) REFERENCES articles(id_article)
);







