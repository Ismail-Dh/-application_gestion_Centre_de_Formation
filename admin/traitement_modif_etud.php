<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Etud']);
    $nouveau_nom = mysqli_real_escape_string($db_conn, $_POST['Nom_Etud']);
    $nouveau_prenom = mysqli_real_escape_string($db_conn, $_POST['Prenom_Etud']);
    $nouveau_telephone = mysqli_real_escape_string($db_conn, $_POST['Num_tele']);
    $nouveau_niveau = mysqli_real_escape_string($db_conn, $_POST['Niveau_scol']);

    // Requête SQL pour modifier les données dans la table des étudiants
    $sql = " UPDATE etudients SET Nom_Etud = '$nouveau_nom', Prenom_Etud = '$nouveau_prenom', Num_tele = '$nouveau_telephone', Niveau_scol = '$nouveau_niveau' WHERE ID_Etud = $ID";
   
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: student-account.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de la modification de l'étudiant : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>