<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$prof_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_prof'])) {
        $prof_id = $_POST['ID_prof'];

        // Supprimer la seance de la classe de ce prof  de la table seances
        $delete_prof_sean_query = "DELETE scences FROM scences
                                      JOIN classes ON scences.ID_Class= classes.ID_Class
                                      JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                      WHERE professeurs.ID_prof = '$prof_id'";
        mysqli_query($db_conn, $delete_prof_sean_query);

       // Supprimer la etudiant_classe de la classe de ce prof  de la table etudiant_classe
       $delete_matiere_sean_query = "DELETE etudiant_classe FROM etudiant_classe
                                      JOIN classes ON etudiant_classe.ID_Class= classes.ID_Class
                                     JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                     WHERE professeurs.ID_prof = '$prof_id'";
        mysqli_query($db_conn, $delete_matiere_sean_query);


        // Supprimer la classe de cette matiere de la table classes
        $delete_matiere_class_query = "DELETE classes FROM classes 
                                      JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                      WHERE professeurs.ID_prof = '$prof_id'";
        // Requête de suppression
       $sql = "DELETE FROM professeurs WHERE ID_prof = '$prof_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "Le professeurs a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun professeur trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de professeur.";
    }
}
?>

<div class="content-header">
    <!-- ... (votre code pour l'en-tête) ... -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Supprimer un professeur</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="prof_id">ID de le professeur</label>
                                <input type="text" class="form-control" id="ID_prof" name="ID_prof" placeholder="Entrez l'ID de le professeur" value="<?= $prof_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer le professeur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>