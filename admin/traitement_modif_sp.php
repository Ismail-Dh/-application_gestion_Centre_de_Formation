<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_Etud']);
    $ID_class = mysqli_real_escape_string($db_conn, $_POST['ID_Class']);
    $nouveau_seancepaye = mysqli_real_escape_string($db_conn, $_POST['Num_sceance_paye']);

    // Requête SQL pour modifier les données dans la table des étudiants
    $sql = " UPDATE etudiant_classe SET nb_seance_payee='$nouveau_seancepaye' WHERE ID_Etud = $ID and ID_Class='$ID_class'";
   
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: etudclass.php");
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