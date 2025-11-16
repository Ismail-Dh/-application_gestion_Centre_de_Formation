<?php
include('../includes/config.php');

if (isset($_POST['login2'])) {
    $nom = $_POST['nom'];
    $id = $_POST['id'];

    // Requête pour vérifier si un etudiant avec l'ID et le nom spécifiés existe
    $etud_query = "SELECT * FROM etudients WHERE ID_Etud = '$id' AND Nom_Etud = '$nom'";
    $etud_result = mysqli_query($db_conn, $etud_query);

    if ($etud_result && mysqli_num_rows($etud_result) > 0) {
        session_start();
        $_SESSION['login2'] = true;
        // Stocker l'ID du professeur dans la session
       $_SESSION['etud_id'] = $id;
        header('Location: ../etud/dashboard.php');
    } else {
        echo 'Aucun etudiant trouvé avec cet ID et ce nom.';
    }
}
?>
