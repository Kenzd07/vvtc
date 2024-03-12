<?php
if (isset($_POST['register'])) {
    // Assurez-vous de configurer correctement la connexion à votre base de données.
    $dsn = "mysql:host=localhost;dbname=vtc;charset=utf8";
    $utilisateurs = "root";
    $mot_de_passe = "";

    try {
        $bdd = new PDO($dsn, $utilisateurs, $mot_de_passe);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    // Insérer l'utilisateur dans la base de données
    $query = "INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($query);
   
$data=array($nom,$prenom,$email,$mot_de_passe);
    if ($stmt->execute($data)) {
        header('Location: index.html'); // Redirigez vers la page de connexion après l'inscription réussie.
    } else {
        echo "Une erreur est survenue lors de l'inscription. Veuillez réessayer.";
    }
}
?>
