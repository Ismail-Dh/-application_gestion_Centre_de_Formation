<?php
session_start();

if (isset($_SESSION['selected_absc_id'])&&isset($_SESSION['selected_sea_id'])) {
    $selected_absc_id = $_SESSION['selected_absc_id'];
    $selected_sea_id = $_SESSION['selected_sea_id'];
    include('../includes/config.php');

    if (isset($_POST['mark_absence'])) {
        if (isset($_POST['absences']) && is_array($_POST['absences'])) {
            foreach ($_POST['absences'] as $etudiant_id => $absence_data) {
                $etudiant_id = mysqli_real_escape_string($db_conn, $absence_data['ID_Etud']);
                $absent = isset($absence_data['present']) ? 1 : 0;

                $seances_payees_query = "SELECT nb_seance_payee, nb_abs FROM etudiant_classe WHERE ID_Etud = '$etudiant_id'";
                $seances_payees_result = mysqli_query($db_conn, $seances_payees_query);
                $row = mysqli_fetch_assoc($seances_payees_result);
                $seances_payees = $row['nb_seance_payee'];
                $nb_abs = $row['nb_abs'];

                $idclass_query = "SELECT ID_Class FROM scences WHERE ID_seance = '$selected_sea_id'";
                $idclass_result = mysqli_query($db_conn, $idclass_query);
                $idclass_row = mysqli_fetch_assoc($idclass_result);
                $idclass = $idclass_row['ID_Class'];

                if ($absent == 0) {
                    if ($seances_payees > 0) {
                        $seances_payees--;
                        $update_seances_payees_query = "UPDATE etudiant_classe SET nb_seance_payee = '$seances_payees' WHERE ID_Class='$idclass' and ID_Etud = '$etudiant_id'";
                        mysqli_query($db_conn, $update_seances_payees_query);
                    }
                } else {

                    if ($nb_abs === null) {
                        $nb_abs = 1;
                        $update_nb_abs_query = "UPDATE etudiant_classe SET nb_abs = '$nb_abs' WHERE ID_Class='$idclass' and ID_Etud = '$etudiant_id'";
                        mysqli_query($db_conn, $update_nb_abs_query);
                    }else{
                        if ($seances_payees > 0) {
                            $seances_payees--;
                            $nb_abs++;
                            $update_seances_payees_query = "UPDATE etudiant_classe SET nb_abs = '$nb_abs', nb_seance_payee = '$seances_payees' WHERE ID_Class='$idclass' and ID_Etud = '$etudiant_id'";
                            mysqli_query($db_conn, $update_seances_payees_query);
                        }
                    }
                 }
        

                $query = "INSERT INTO liste_abscence (ID_absc, ID_Etud, abscence) VALUES ('$selected_absc_id', '$etudiant_id', '$absent') ";
                mysqli_query($db_conn, $query);
            }
        }
        header("Location: prof_abscence.php");
        exit();
    } else {
        echo "Aucune donnée pour marquer les absences.";
    }
} else {
    echo "ID d'absence sélectionné non disponible.";
}
?>
