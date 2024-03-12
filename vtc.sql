-- Table Utilisateurs
CREATE TABLE Utilisateurs (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255),
    mot_de_passe VARCHAR(255),
    telephone VARCHAR(15),
    adresse TEXT,
    role ENUM('chauffeur', 'client')
);

-- Table Chauffeurs
CREATE TABLE Chauffeurs (
    chauffeur_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    numero_de_permis VARCHAR(20),
    date_d_embauche DATE,
    note_moyenne DECIMAL(3, 2),
    FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id)
);

-- Table Véhicules
CREATE TABLE Vehicules (
    vehicule_id INT PRIMARY KEY AUTO_INCREMENT,
    chauffeur_id INT,
    modele VARCHAR(255),
    annee INT,
    plaque_immatriculation VARCHAR(20),
    capacite_passagers INT,
    FOREIGN KEY (chauffeur_id) REFERENCES Chauffeurs(chauffeur_id)
);

-- Table Courses
CREATE TABLE Courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    chauffeur_id INT,
    vehicule_id INT,
    date_heure_depart DATETIME,
    lieu_depart VARCHAR(255),
    lieu_arrivee VARCHAR(255),
    distance DECIMAL(10, 2),
    tarif DECIMAL(10, 2),
    FOREIGN KEY (client_id) REFERENCES Utilisateurs(user_id),
    FOREIGN KEY (chauffeur_id) REFERENCES Chauffeurs(chauffeur_id),
    FOREIGN KEY (vehicule_id) REFERENCES Vehicules(vehicule_id)
);

-- Table Historique_Courses
CREATE TABLE Historique_Courses (
    historique_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    date_heure_achevement DATETIME,
    duree TIME,
    note_client INT,
    commentaire_client TEXT,
    note_chauffeur INT,
    commentaire_chauffeur TEXT,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);
