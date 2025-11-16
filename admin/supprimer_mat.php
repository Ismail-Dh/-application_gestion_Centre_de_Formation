<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de la matiere
$mat_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Matiere'])) {
        $mat_id = $_POST['ID_Matiere'];

         // Supprimer la classe de cette matiere de la table seances
         $delete_matiere_sean_query = "DELETE scences FROM scences
                                       JOIN classes ON scences.ID_Class= classes.ID_Class
                                       JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                       WHERE professeurs.ID_Matiere = '$mat_id'";
         mysqli_query($db_conn, $delete_matiere_sean_query);

          // Supprimer la classe de cette matiere de la table etudiant_classe
          $delete_matiere_sean_query = "DELETE etudiant_classe FROM etudiant_classe
                                        JOIN classes ON etudiant_classe.ID_Class= classes.ID_Class
                                        JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                        WHERE professeurs.ID_Matiere = '$mat_id'";
          mysqli_query($db_conn, $delete_matiere_sean_query);
         

        // Supprimer la classe de cette matiere de la table classes
        $delete_matiere_class_query = "DELETE classes FROM classes 
                                       JOIN professeurs ON classes.ID_prof = professeurs.ID_prof 
                                       WHERE professeurs.ID_Matiere = '$mat_id'";
        mysqli_query($db_conn, $delete_matiere_class_query);
        // Supprimer le professeurs de cette matiere de la table professeurs
          $delete_matiere_prof_query = "DELETE FROM professeurs WHERE professeurs.ID_Matiere = '$mat_id'";
            mysqli_query($db_conn, $delete_matiere_prof_query);
       
        // Requête de suppression
       $sql = "DELETE FROM matieres WHERE ID_Matiere = '$mat_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "La matiere a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun matiere trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de matiere.";
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
                        <h3 class="card-title">Supprimer une matiere</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="mat_id">ID de la classe</label>
                                <input type="text" class="form-control" id="ID_Matiere" name="ID_Matiere" placeholder="Entrez l'ID de la matiere" value="<?= $mat_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer la matiere</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>