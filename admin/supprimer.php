<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$etudiant_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Etud'])) {
        $etudiant_id = $_POST['ID_Etud'];

        // Supprimer l'étudiant de la table etudiant_classe
        $delete_student_class_query = "DELETE FROM etudiant_classe WHERE ID_Etud = '$etudiant_id'";
        mysqli_query($db_conn, $delete_student_class_query);

        // Requête de suppression
       $sql = "DELETE FROM etudients WHERE ID_Etud = $etudiant_id";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "L'étudiant a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun étudiant trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID d'étudiant.";
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
                        <h3 class="card-title">Supprimer un étudiant</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="etudiant_id">ID de l'étudiant</label>
                                <input type="text" class="form-control" id="ID_Etud" name="ID_Etud" placeholder="Entrez l'ID de l'étudiant" value="<?= $etudiant_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer l'étudiant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>