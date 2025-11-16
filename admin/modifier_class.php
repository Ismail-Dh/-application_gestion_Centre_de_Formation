<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$class_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Class'])) {
        $class_id = $_POST['ID_Class'];

        // Requête pour récupérer les données de l'étudiant à modifier
        $select_query = "SELECT * FROM classes WHERE ID_Class = '$class_id'";
        $result = mysqli_query($db_conn, $select_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $class = mysqli_fetch_assoc($result);
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
                        <h3 class="card-title">Modifier un étudiant</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="class_id">ID de la classe</label>
                                <input type="text" class="form-control" id="ID_Class" name="ID_Class" placeholder="Entrez l'ID de la classe" value="<?= $class_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger la classe</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($class) && !empty($class)) { ?>
                    <!-- Formulaire de modification avec les données de la classe chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations de la classe</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_class.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type_fonction" name="type_fonction" value="<?= $class['type_fonction'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="id_prof">ID professeur</label>
                                    <input type="text" class="form-control" id="ID_prof" name="ID_prof" value="<?= $class['ID_prof'] ?>">
                                </div>
                                
                                <input type="hidden" name="ID_Class" value="<?= $class['ID_Class'] ?>">
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