<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $IDabs = mysqli_real_escape_string($db_conn, $_POST['ID_absc']);
    $IDetud = mysqli_real_escape_string($db_conn, $_POST['ID_Etud']);
    $absc = mysqli_real_escape_string($db_conn, $_POST['abscence']);

  
    // Requête SQL pour modifier les données dans la table liste_abscence
    $sql = "UPDATE liste_abscence SET abscence = '$absc'  WHERE ID_absc = '$IDabs' and ID_Etud='$IDetud'";
    
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: abscence.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de la modification de l'abscence : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>