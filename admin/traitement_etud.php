<?php 
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Etud']);
    $nom = mysqli_real_escape_string($db_conn, $_POST['Nom_Etud']);
    $prenom = mysqli_real_escape_string($db_conn, $_POST['Prenom_Etud']);
    $telephone = mysqli_real_escape_string($db_conn, $_POST['Num_tele']);
    $niveau = mysqli_real_escape_string($db_conn, $_POST['Niveau_scol']);


    // Requête SQL pour insérer les données dans la table des étudiants
    $insert_query = "INSERT INTO etudients (ID_Etud, Nom_Etud, Prenom_Etud, Num_tele, Niveau_scol) VALUES ('$ID','$nom', '$prenom', '$telephone','$niveau')";
    
    if (mysqli_query($db_conn, $insert_query)) {
        // Succès de l'insertion, redirection vers une page de succès par exemple
        header("Location: student-account.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de l'ajout de l'étudiant : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>
