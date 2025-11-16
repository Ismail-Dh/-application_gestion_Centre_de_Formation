<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de la matiere
$mat_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Matiere'])) {
        $mat_id = $_POST['ID_Matiere'];

        // Requête pour récupérer les données de la matiere à modifier
        $select_query = "SELECT * FROM matieres WHERE ID_Matiere = '$mat_id'";
        $result = mysqli_query($db_conn, $select_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $mat = mysqli_fetch_assoc($result);
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
                        <h3 class="card-title">Modifier une matiere</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="mat_id">ID de la matiere</label>
                                <input type="text" class="form-control" id="ID_Matiere" name="ID_Matiere" placeholder="Entrez l'ID de la matiere" value="<?= $mat_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger la matiere</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($mat) && !empty($mat)) { ?>
                    <!-- Formulaire de modification avec les données de la matiere chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations de la matiere</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_mat.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $mat['nom'] ?>">
                                </div>
                               
                                <input type="hidden" name="ID_Matiere" value="<?= $class['ID_Matiere'] ?>">
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