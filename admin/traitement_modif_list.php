<?php
include('../includes/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_absence'], $_POST['ID_seance'])) {
        $absence_id = $_POST['ID_absence'];
        $seance_id = $_POST['ID_seance'];

        // Requête pour mettre à jour l'ID de séance de l'absence dans la base de données
        $update_query = "UPDATE abscence SET ID_seance = '$seance_id' WHERE ID_absc = '$absence_id'";

        if (mysqli_query($db_conn, $update_query)) {
            // Redirection vers une page après la modification réussie
            header("Location: liste_abs.php");
            exit();
        } else {
            // Gestion des erreurs lors de la modification
            echo "Erreur lors de la modification : " . mysqli_error($db_conn);
        }
    } else {
        echo "Données manquantes pour la modification.";
    }
} else {
    echo "Accès non autorisé.";
}
?>
