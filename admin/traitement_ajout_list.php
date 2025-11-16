<?php
    include('../includes/config.php');

    // Vérification si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire, assurez-vous de nettoyer et valider les entrées utilisateur pour des raisons de sécurité
        $id_absence = $_POST['id_absence']; // Champ pour l'ID d'absence
        $id_seance = $_POST['id_seance']; // Champ pour l'ID de séance

        // Requête d'insertion dans la base de données
        $insert_query = "INSERT INTO abscence (ID_absc, ID_seance) VALUES ('$id_absence', '$id_seance')";

        // Exécution de la requête
        if (mysqli_query($db_conn, $insert_query)) {
            // Redirection vers une page après l'ajout réussi
            header("Location: liste_abs.php");
            exit();
        } else {
            // Gestion des erreurs lors de l'insertion
            echo "Erreur lors de l'ajout : " . mysqli_error($db_conn);
        }
    }
?>