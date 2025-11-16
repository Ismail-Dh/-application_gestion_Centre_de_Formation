<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de liste abscence
$abs_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_absc'])) {
        $abs_id = $_POST['ID_absc'];

      
       $sql = "DELETE FROM liste_abscence WHERE ID_absc = '$abs_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "La liste d'abscence a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun liste d'abscence trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de la liste d'abscence.";
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
                        <h3 class="card-title">Supprimer une liste d'abscence</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="abs_id">ID de la la liste d'abscence</label>
                                <input type="text" class="form-control" id="ID_absc" name="ID_absc" placeholder="Entrez l'ID de la liste d'abscence" value="<?= $abs_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer la liste</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>