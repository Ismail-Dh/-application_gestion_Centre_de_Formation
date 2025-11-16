<?php 
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_seance']);
    $numb = mysqli_real_escape_string($db_conn, $_POST['Numb_scence']);
    $date = mysqli_real_escape_string($db_conn, $_POST['Date_seance']);
    $hd = mysqli_real_escape_string($db_conn, $_POST['heur_debut']);
    $hf = mysqli_real_escape_string($db_conn, $_POST['heur_fin']);
    $prix = mysqli_real_escape_string($db_conn, $_POST['prix']);
    $idclass = mysqli_real_escape_string($db_conn, $_POST['ID_Class']);
    $numsalle = mysqli_real_escape_string($db_conn, $_POST['numero_salle']);
    // Requête SQL pour insérer les données dans la table des professeurs
    $insert_query = "INSERT INTO scences (ID_seance, Numb_scence,Date_seance, heur_debut,heur_fin,prix,ID_Class,numero_salle) VALUES ('$ID','$numb', '$date', '$hd','$hf','$prix','$idclass','$numsalle')";
    
    if (mysqli_query($db_conn, $insert_query)) {
        // Succès de l'insertion, redirection vers une page de succès par exemple
        header("Location: seance.php");
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