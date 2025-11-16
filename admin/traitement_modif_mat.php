<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Matiere']);
    $nom = mysqli_real_escape_string($db_conn, $_POST['nom']);
  
    // Requête SQL pour modifier les données dans la table des matieres
    $sql = "UPDATE matieres SET nom = '$nom'  WHERE ID_Matiere = '$ID'";
    
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: matiere.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de la modification de la matiere : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>