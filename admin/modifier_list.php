<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID d'absence
$absence_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_absence'])) {
        $absence_id = $_POST['ID_absence'];

        // Requête pour récupérer les données de l'absence à modifier
        $select_query = "SELECT * FROM abscence WHERE ID_absc = '$absence_id'";
        $result = mysqli_query($db_conn, $select_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $absence = mysqli_fetch_assoc($result);
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
                        <h3 class="card-title">Modifier une absence</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="absence_id">ID de l'absence</label>
                                <input type="text" class="form-control" id="ID_absence" name="ID_absence" placeholder="Entrez l'ID de l'absence" value="<?= $absence_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger l'absence</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($absence) && !empty($absence)) { ?>
                    <!-- Formulaire de modification avec les données de l'absence chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations de l'absence</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_list.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="seance_id">ID de séance</label>
                                    <select class="form-control" id="ID_seance" name="ID_seance">
                                        <?php
                                        // Récupérer les choix possibles pour l'ID de séance depuis la base de données
                                        $seance_query = "SELECT ID_seance FROM scences"; // Remplacez 'seance' par votre table
                                        $seance_result = mysqli_query($db_conn, $seance_query);
                                        while ($row = mysqli_fetch_assoc($seance_result)) {
                                            $seance_option = $row['ID_seance'];
                                            echo "<option value='$seance_option' " . ($absence['ID_seance'] == $seance_option ? 'selected' : '') . ">$seance_option</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="hidden" name="ID_absence" value="<?= $absence['ID_absc'] ?>">
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
