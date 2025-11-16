<?php


include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Récupérer l'ID du professeur depuis la session
$professeur_id = $_SESSION['prof_id'];

if (isset($_POST['show_students'])) {
    $seance_id = $_POST['seance_id'];

    // Récupérer les étudiants concernés par cette séance
    $etudiants_query = "SELECT DISTINCT etudients.ID_Etud, etudients.Nom_Etud, etudients.Prenom_Etud 
                        FROM etudients 
                        JOIN etudiant_classe ON etudients.ID_Etud = etudiant_classe.ID_Etud
                        JOIN scences ON etudiant_classe.ID_Class = scences.ID_Class
                        JOIN abscence ON scences.ID_seance = abscence.ID_seance
                        JOIN classes ON classes.ID_Class=scences.ID_Class
                        JOIN professeurs ON classes.ID_prof = professeurs.ID_prof
                        WHERE scences.ID_seance = '$seance_id' AND professeurs.ID_prof='$professeur_id'";

    $etudiants_result = mysqli_query($db_conn, $etudiants_query);

    // Stocker l'ID de l'absence sélectionnée dans une variable de session
    $_SESSION['selected_absc_id'] = $_POST['absc_id'];
    $_SESSION['selected_sea_id']= $_POST['seance_id'];
?>

<div class="container">
    <h1>Liste des étudiants :</h1>
    <form method="POST" action="traitement_prof_absences.php">
        <?php     
        while ($etudiant = mysqli_fetch_assoc($etudiants_result)) :
        ?>
            <input type="checkbox" name="absences[<?= $etudiant['ID_Etud'] ?>][present]" value="1">
            <label><?= $etudiant['Nom_Etud'] ?> <?= $etudiant['Prenom_Etud'] ?></label><br>
            <input type="hidden" name="absences[<?= $etudiant['ID_Etud'] ?>][ID_Etud]" value="<?= $etudiant['ID_Etud'] ?>">
        <?php  endwhile; ?>

        <input type="hidden" name="selected_absc_id" value="<?= $_SESSION['selected_absc_id'] ?>">
        <input type="hidden" name="selected_sea_id" value="<?= $_SESSION['selected_sea_id'] ?>">
        <button type="submit" name="mark_absence">Enregistrer les absences</button>
    </form>
</div>

<?php
}
include('footer.php');
?>

