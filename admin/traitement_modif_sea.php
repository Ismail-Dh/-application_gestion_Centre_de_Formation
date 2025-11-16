<?php
include('../includes/config.php');
?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs et nettoyage des données 
    $ID = mysqli_real_escape_string($db_conn, $_POST['ID_seance']);
    $num = mysqli_real_escape_string($db_conn, $_POST['Numb_scence']);
    $date = mysqli_real_escape_string($db_conn, $_POST['Date_seance']);
    $hd = mysqli_real_escape_string($db_conn, $_POST['heur_debut']);
    $hf = mysqli_real_escape_string($db_conn, $_POST['heur_fin']);
    $prix = mysqli_real_escape_string($db_conn, $_POST['prix']);
    $idclass = mysqli_real_escape_string($db_conn, $_POST['ID_Class']);
    $idsalle = mysqli_real_escape_string($db_conn, $_POST['numero_salle']);
    // Requête SQL pour modifier les données dans la table des seances
    $sql = "UPDATE scences SET Numb_scence = '$num', Date_seance = '$date', heur_debut = '$hd', heur_fin= '$hf', prix= '$prix ' , ID_Class='$idclass',numero_salle='$idsalle' WHERE ID_seance = '$ID'";
    
    if (mysqli_query($db_conn, $sql)) {
        // Succès de la modification, redirection vers une page de succès par exemple
        header("Location: seance.php");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, gestion de l'erreur
        echo "Erreur lors de la modification de la seance : " . mysqli_error($db_conn);
    }
} else {
    // Si la méthode de requête n'est pas POST, redirection vers une page d'erreur par exemple
    header("Location: erreur.php");
    exit();
}
?>