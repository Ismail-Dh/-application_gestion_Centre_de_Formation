<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de la liste des abscence
$abs_id = '';
$etud_id ='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_absc'])&&isset($_POST['ID_Etud'])) {
        $abs_id = $_POST['ID_absc'];
        $etud_id =$_POST['ID_Etud'];
        // Requête pour récupérer les données de la liste à modifier
        $select_query = "SELECT * FROM liste_abscence WHERE ID_absc = '$abs_id' and ID_Etud ='$etud_id'";
        $result = mysqli_query($db_conn, $select_query);

        
        if ($result && mysqli_num_rows($result) > 0) {
            $abs = mysqli_fetch_assoc($result);
        } else {
            echo "Aucun liste trouvé avec cet ID.";
        }
    } else {
        echo "Veuillez fournir un ID de liste.";
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
                        <h3 class="card-title">Modifier une abscence</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="abs_id">ID de la liste d'abscence</label>
                                <input type="text" class="form-control" id="ID_absc" name="ID_absc" placeholder="Entrez l'ID de la liste" value="<?= $abs_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="etud_id">ID de l'etudiant</label>
                                <input type="text" class="form-control" id="ID_Etud" name="ID_Etud" placeholder="Entrez l'ID de l'etudiant" value="<?= $etud_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger </button>
                        </div>
                    </form>
                </div>
                <?php if (isset($abs) && !empty($abs)) { ?>
                    <!-- Formulaire de modification avec les données de la classe chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations de l'abscence</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_abs.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="abs">Abscence</label>
                                    <input type="text" class="form-control" id="abscence" name="abscence" value="<?= $abs['abscence'] ?>">
                                </div>
                               
                                <input type="hidden" name="ID_absc" value="<?= $abs['ID_absc'] ?>">
                                <input type="hidden" name="ID_Etud" value="<?= $abs['ID_Etud'] ?>">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                    
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>