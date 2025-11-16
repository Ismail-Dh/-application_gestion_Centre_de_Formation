<?php


// Inclure le fichier de configuration et les fichiers requis
include('../includes/config.php'); // Assurez-vous de spécifier le chemin correct
include('header.php');
include('sidebar.php');

// Récupérer l'ID du professeur depuis la session
$professeur_id = $_SESSION['prof_id'];

// Récupérer les ID des absences existantes pour ce professeur
$id_abscences_query = "SELECT ID_absc FROM abscence,scences,classes,professeurs
                       WHERE abscence.ID_seance=scences.ID_seance and scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id'";
$id_abscences_result = mysqli_query($db_conn, $id_abscences_query);

// Récupérer les ID des séances de ce professeur
$id_seances_query = "SELECT ID_seance FROM scences,classes,professeurs
                      WHERE scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id'";
$id_seances_result = mysqli_query($db_conn, $id_seances_query);

// Afficher le formulaire pour marquer les absences
?>
<div class="container">
    <h1>Marquer les absences</h1>
    <form method="POST" action="prof_list_etud.php">
        <h3>ID des absences existantes :</h3>
        <select name="absc_id">
           <?php while ($id_abscence = mysqli_fetch_assoc($id_abscences_result)) : ?>
            <option value="<?= $id_abscence['ID_absc'] ?>"><?= $id_abscence['ID_absc'] ?></option>
          <?php endwhile; ?>
        </select>
        <input type="hidden" name="selected_absc_id" value="<?= $id_abscence['ID_absc'] ?>">
        <h3>ID des séances :</h3>
       
        <select name="seance_id">
            <?php while ($id_seance = mysqli_fetch_assoc($id_seances_result)) : ?>
                <option value="<?= $id_seance['ID_seance'] ?>"><?= $id_seance['ID_seance'] ?></option>
            <?php endwhile; ?>
            
        </select>
        <input type="hidden" name="selected_sea_id" value="<?= $id_abscence['ID_seance'] ?>">


        <button type="submit" name="show_students">Afficher les étudiants</button>
    </form>
</div>

<?php
include('footer.php');
?>
