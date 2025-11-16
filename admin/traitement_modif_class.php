<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Class']);
    $nouveau_type = mysqli_real_escape_string($db_conn, $_POST['type_fonction']);
    $nouveau_id_prof = mysqli_real_escape_string($db_conn, $_POST['ID_prof']);

    // Requête SQL pour modifier les données dans la table des professeurs
    $sql = "UPDATE classes SET type_fonction = '$nouveau_type', ID_prof = '$nouveau_id_prof'  WHERE ID_Class = '$ID'";
    
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: class.php");
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