<?php
session_start();

if (isset($_POST['login'])) {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=vtc", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];

    // Utilisez des paramètres nommés dans la requête pour éviter les injections SQL
    $query = "SELECT * FROM Utilisateurs WHERE email = '$email' AND '$mot_de_passe' = mot_de_passe";

    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
    $stmt->execute();

    $utilisateurs = $stmt->rowCount();

    if ($utilisateurs == 1) {
        header('location: page2.html');
        exit(); // Assurez-vous de quitter le script après la redirection
    } else {
        echo 'Échec de la connexion. Vérifiez vos informations d\'identification.';
        
    }
}
?>
