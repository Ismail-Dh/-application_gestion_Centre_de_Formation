<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'absence
$abs_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_absence'])) {
        $abs_id = $_POST['ID_absence'];

        // Supprimer la lise  de id absence  de la table liste_absence
        $delete_abs_list_query = "DELETE liste_abscence FROM liste_abscence
                                      JOIN abscence ON abscence.ID_absc= liste_abscence.ID_absc
                                      WHERE liste_abscence.ID_absc = '$abs_id'";
        mysqli_query($db_conn, $delete_abs_list_query);

        $sql = "DELETE FROM abscence WHERE ID_absc = '$abs_id'";
        
        if (mysqli_query($db_conn, $sql)) {
            echo "L'absence a été supprimée avec succès.";
            
            exit();
        } else {
            echo "Aucune absence trouvée avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID d'absence.";
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
                        <h3 class="card-title">Supprimer une absence</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="abs_id">ID de l'absence</label>
                                <input type="text" class="form-control" id="ID_absence" name="ID_absence" placeholder="Entrez l'ID de l'absence" value="<?= $abs_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Supprimer l'absence</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>
