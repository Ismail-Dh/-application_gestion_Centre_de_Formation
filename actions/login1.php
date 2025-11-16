<?php
include('../includes/config.php');

if (isset($_POST['login1'])) {
    $nom = $_POST['nom'];
    $id = $_POST['id'];

    // Requête pour vérifier si un professeur avec l'ID et le nom spécifiés existe
    $prof_query = "SELECT * FROM professeurs WHERE ID_prof = '$id' AND nom_prof = '$nom'";
    $prof_result = mysqli_query($db_conn, $prof_query);

    if ($prof_result && mysqli_num_rows($prof_result) > 0) {
        session_start();
        $_SESSION['login1'] = true;
        // Stocker l'ID du professeur dans la session
       $_SESSION['prof_id'] = $id;
        header('Location: ../prof/dashboard.php');
    } else {
        echo 'Aucun professeur trouvé avec cet ID et ce nom.';
    }
}
?>







