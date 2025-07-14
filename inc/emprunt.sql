CREATE DATABASE emprunter;
USE emprunter;

CREATE TABLE emprunter_membre(
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(100)
);

CREATE TABLE emprunter_categorie_objet(
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);

CREATE TABLE emprunter_objet(
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_membre INT,
    id_categorie INT,
    FOREIGN KEY (id_membre) REFERENCES emprunter_membre(id_membre),
    FOREIGN KEY (id_categorie) REFERENCES emprunter_categorie_objet(id_categorie)
);

CREATE TABLE emprunter_images_objet(
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(100),
    FOREIGN KEY (id_objet) REFERENCES emprunter_objet(id_objet)
);

CREATE TABLE emprunter_emprunt(
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES emprunter_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES emprunter_membre(id_membre)
);

INSERT INTO emprunter_membre (nom, prenom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Dupont', 'Jean', '1990-05-12', 'M', 'jean.dupont@email.com', 'Paris', 'mdp123', 'pdp1.jpg'),
('Martin', 'Sophie', '1985-08-23', 'F', 'sophie.martin@email.com', 'Lyon', 'mdp456', 'pdp2.jpg'),
('Durand', 'Paul', '1992-11-03', 'M', 'paul.durand@email.com', 'Marseille', 'mdp789', 'pdp3.jpg'),
('Lefevre', 'Claire', '1988-02-17', 'F', 'claire.lefevre@email.com', 'Toulouse', 'mdp321', 'pdp4.jpg');

INSERT INTO emprunter_categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

INSERT INTO emprunter_objet (nom_objet, id_membre, id_categorie) VALUES
('Sèche-cheveux', 1, 1),
('Perceuse', 1, 2),
('Tournevis', 1, 2),
('Mixeur', 1, 4),
('Casserole', 1, 4),
('Clé à molette', 1, 3),
('Fer à lisser', 1, 1),
('Batteur électrique', 1, 4),
('Pinceau', 1, 1),
('Pompe à vélo', 1, 3),

('Bouilloire', 2, 4),
('Pince multiprise', 2, 3),
('Vernis à ongles', 2, 1),
('Scie sauteuse', 2, 2),
('Cafetière', 2, 4),
('Tournevis cruciforme', 2, 2),
('Lisseur', 2, 1),
('Marmite', 2, 4),
('Clé plate', 2, 3),
('Pinceau maquillage', 2, 1),

('Perceuse à percussion', 3, 2),
('Fouet', 3, 4),
('Clé Allen', 3, 3),
('Sèche-cheveux professionnel', 3, 1),
('Scie circulaire', 3, 2),
('Cocotte-minute', 3, 4),
('Pince universelle', 3, 3),
('Brosse à cheveux', 3, 1),
('Tournevis plat', 3, 2),
('Poêle', 3, 4),

('Fer à repasser', 4, 1),
('Perceuse sans fil', 4, 2),
('Clé dynamométrique', 4, 3),
('Mixeur plongeant', 4, 4),
('Pince coupante', 4, 3),
('Brosse visage', 4, 1),
('Scie égoïne', 4, 2),
('Casserole inox', 4, 4),
('Tournevis étoile', 4, 2),
('Lisseur vapeur', 4, 1);

INSERT INTO emprunter_images_objet (id_objet, nom_image) VALUES
(1,'est1.jpg'),
(2,'bri.jpg'),
(3,'bri2.jpg'),
(4,'cui1.jpg'),
(5,'cui2.jpg'),
(6,'mec1.jpg'),
(7,'est2.jpg'),
(8,'cui3.jpg'),
(9,'est3.jpg'),
(10,'mec2.jpg'),

(11,'cui4.jpg'),
(12,'mec3.jpg'),
(13,'est4.jpg'),
(14,'bri3.jpg'),
(15,'cui5.jpg'),
(16,'bri4.jpg'),
(17,'est5.jpg'),
(18,'cui6.jpg'),
(19,'mec4.jpg'),
(20,'est6.jpg'),

(21,'bri5.jpg'),
(22,'cui7.jpg'),
(23,'mec5.jpg'),
(24,'est7.jpg'),
(25,'bri6.jpg'),
(26,'cui8.jpg'),
(27,'mec6.jpg'),
(28,'est8.jpg'),
(29,'bri7.jpg'),
(30,'cui9.jpg'),

(31,'est9.jpg'),
(32,'bri8.jpg'),
(33,'mec7.jpg'),
(34,'cui9.jpg'),
(35,'mc8.jpg'),
(36,'est9.jpg'),
(37,'bri9.jpg'),
(38,'cui10.jpg'),
(39,'bri10.jpg'),
(40,'est11.jpg');

INSERT INTO emprunter_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2024-06-01', '2024-06-10'),
(2, 3, '2024-06-02', '2024-06-11'),
(3, 4, '2024-06-03', '2024-06-12'),
(4, 1, '2024-06-04', '2024-06-13'),
(5, 2, '2024-06-05', '2024-06-14'),
(6, 3, '2024-06-06', '2024-06-15'),
(7, 4, '2024-06-07', '2024-06-16'),
(8, 1, '2024-06-08', '2024-06-17'),
(9, 2, '2024-06-09', '2024-06-18'),
(10, 3, '2024-06-10', '2024-06-19');

CREATE OR REPLACE VIEW vue_objets_membre AS
SELECT o.id_objet, o.nom_objet, img.nom_image AS image_objet, c.nom_categorie, o.id_membre,
       m.nom AS nom_emprunteur, m.prenom AS prenom_emprunteur
FROM emprunter_objet o
JOIN emprunter_categorie_objet c ON o.id_categorie = c.id_categorie
LEFT JOIN emprunter_emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NOT NULL
LEFT JOIN emprunter_membre m ON e.id_membre = m.id_membre
LEFT JOIN emprunter_images_objet img ON o.id_objet = img.id_objet;

CREATE OR REPLACE VIEW vue_objets_categorie AS
SELECT o.id_objet, o.nom_objet, img.nom_image AS image_objet, c.nom_categorie,
       m.nom AS nom_emprunteur, m.prenom AS prenom_emprunteur,
       e.date_emprunt, e.date_retour
FROM emprunter_objet o
JOIN emprunter_categorie_objet c ON o.id_categorie = c.id_categorie
LEFT JOIN emprunter_emprunt e ON o.id_objet = e.id_objet
LEFT JOIN emprunter_membre m ON e.id_membre = m.id_membre
LEFT JOIN emprunter_images_objet img ON o.id_objet = img.id_objet;
