<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$class_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Class'])) {
        $class_id = $_POST['ID_Class'];

        // Supprimer la classe de la table etudiant_classe
        $delete_student_class_query = "DELETE FROM etudiant_classe WHERE ID_Class = '$class_id'";
        mysqli_query($db_conn, $delete_student_class_query);

        // Supprimer la classe de la table etudiant_classe
        $delete_seance_class_query = "DELETE FROM scences WHERE ID_Class = '$class_id'";
        mysqli_query($db_conn, $delete_seance_class_query);
        // Requête de suppression
       $sql = "DELETE FROM classes WHERE ID_Class = '$class_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "La classe a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun classe trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de classe.";
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
                        <h3 class="card-title">Supprimer une classe</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="class_id">ID de la classe</label>
                                <input type="text" class="form-control" id="ID_Class" name="ID_Class" placeholder="Entrez l'ID de la classe" value="<?= $class_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer la classe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>