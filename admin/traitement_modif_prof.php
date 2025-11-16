<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_prof']);
    $nouveau_nom = mysqli_real_escape_string($db_conn, $_POST['nom_prof']);
    $nouveau_prenom = mysqli_real_escape_string($db_conn, $_POST['prenom_prof']);
    $nouveau_telephone = mysqli_real_escape_string($db_conn, $_POST['telephone']);
    $nouveau_adresse = mysqli_real_escape_string($db_conn, $_POST['adresse']);
    $nouveau_matiere = mysqli_real_escape_string($db_conn, $_POST['ID_matiere']);

    // Requête SQL pour modifier les données dans la table des professeurs
    $sql = "UPDATE professeurs SET nom_prof = '$nouveau_nom', prenom_prof = '$nouveau_prenom', telephone = '$nouveau_telephone', adresse = '$nouveau_adresse', ID_matiere = '$nouveau_matiere' WHERE ID_prof = '$ID'";
    
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: prof.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de la modification de le professeur : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>