<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$sea_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_seance'])) {
        $sea_id = $_POST['ID_seance'];

      
       $sql = "DELETE FROM scences WHERE ID_seance = '$sea_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "La seance a été supprimé avec succès.";
            exit();
        } else {
            echo "Aucun seance trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de seance.";
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
                        <h3 class="card-title">Supprimer une seance</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sea_id">ID de la seance</label>
                                <input type="text" class="form-control" id="ID_seance" name="ID_seance" placeholder="Entrez l'ID de la seance" value="<?= $sea_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer la seance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>