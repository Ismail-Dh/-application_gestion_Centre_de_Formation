<?php 
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Matiere']);
    $nom = mysqli_real_escape_string($db_conn, $_POST['nom']);
    // Requête SQL pour insérer les données dans la table des matieres
    $insert_query = "INSERT INTO matieres (ID_Matiere,nom) VALUES ('$ID','$nom')";
    
    if (mysqli_query($db_conn, $insert_query)) {
        // Succès de l'insertion, redirection vers la page des matieres
        header("Location: matiere.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de l'ajout de professeur : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>