-- SQL Code for creating the schema

CREATE  DATABASE IF NOT EXISTS DriveLoc;

USE DriveLoc;

CREATE TABLE IF NOT EXISTS roles (
    role_id int NOT NULL AUTO_INCREMENT,
    role_name varchar(100),
    PRIMARY KEY(role_id)
);

CREATE TABLE IF NOT EXISTS users (
    user_id int NOT NULL AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    prenom varchar(100) NOT NULL,
    email varchar(100) UNIQUE NOT NULL,
    password varchar(100) NOT NULL,
    token varchar(255),
    fk_role_id int NOT NULL,
    PRIMARY KEY(user_id),
    FOREIGN KEY(fk_role_id) REFERENCES roles(role_id)
);


CREATE TABLE IF NOT EXISTS categories (
    categorie_id int NOT NULL AUTO_INCREMENT,
    categorie_nom varchar(100),
    PRIMARY KEY(categorie_id)
);


CREATE TABLE IF NOT EXISTS vehicules (
    vehicule_id int NOT NULL AUTO_INCREMENT,
    vehicule_prix DECIMAL NOT NULL,
    vehicule_disponibilite ENUM('Available', 'NonAvailable') DEFAULT 'Available',
    vehicule_marque varchar(100) NOT NULL, -- peut etre normalisé
    vehicule_modele varchar(100) NOT NULL, -- peut etre normalisé
    vehicule_annee YEAR NOT NULL,
    fk_user_id int NOT NULL,
    fk_categorie_id int NOT NULL,
    PRIMARY KEY(vehicule_id),
    FOREIGN KEY(fk_user_id) REFERENCES users(user_id),
    FOREIGN KEY(fk_categorie_id) REFERENCES categories (categorie_id)
);

CREATE TABLE IF NOT EXISTS reservation (
    reservation_id int NOT NULL AUTO_INCREMENT,
    reservation_status ENUM('Pending', 'Approuve', 'Reject') DEFAULT 'Pending',
    reservation_date DATE NOT NULL,
    reservation_lieux varchar(255) NOT NULL,
    fk_user_id int NOT NULL,
    fk_vehicule_id int NOT NULL,
    PRIMARY KEY(reservation_id),
    FOREIGN KEY(fk_user_id) REFERENCES users (user_id),
    FOREIGN KEY(fk_vehicule_id) REFERENCES vehicules (vehicule_id)
);

CREATE TABLE IF NOT EXISTS avis (
    avis_id int NOT NULL AUTO_INCREMENT,
    avis_rating int NOT NULL,
    fk_user_id int NOT NULL,
    fk_vehicule_id int NOT NULL,
    is_deleted BOOLEAN DEFAULT FALSE,
    PRIMARY KEY(avis_id),
    FOREIGN KEY(fk_user_id) REFERENCES users(user_id),
    FOREIGN KEY(fk_vehicule_id) REFERENCES vehicules(vehicule_id)
);

-- Views
CREATE VIEW AvisForVehicule as
SELECT CONCAT(U.prenom, ' ', U.nom) AS fullname, A.avis_rating, A.fk_vehicule_id, A.is_deleted
FROM avis A
         JOIN users U ON A.fk_user_id = U.user_id
