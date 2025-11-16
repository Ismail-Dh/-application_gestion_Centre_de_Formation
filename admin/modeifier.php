<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$etudiant_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Etud'])) {
        $etudiant_id = $_POST['ID_Etud'];

        // Requête pour récupérer les données de l'étudiant à modifier
        $select_query = "SELECT * FROM etudients WHERE ID_Etud = $etudiant_id";
        $result = mysqli_query($db_conn, $select_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $etudiant = mysqli_fetch_assoc($result);
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
                                <label for="etudiant_id">ID de l'étudiant</label>
                                <input type="text" class="form-control" id="ID_Etud" name="ID_Etud" placeholder="Entrez l'ID de l'étudiant" value="<?= $etudiant_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger l'étudiant</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($etudiant) && !empty($etudiant)) { ?>
                    <!-- Formulaire de modification avec les données de l'étudiant chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations de l'étudiant</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_etud.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="Nom_Etud" name="Nom_Etud" value="<?= $etudiant['Nom_Etud'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="Prenom_Etud" name="Prenom_Etud" value="<?= $etudiant['Prenom_Etud'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="niveau">Niveau scolaire</label>
                                    <input type="text" class="form-control" id="Niveau_scol"  name="Niveau_scol" value="<?= $etudiant['Niveau_scol'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="niveau">Téléphone</label>
                                    <input type="text" class="form-control" id="Num_tele" name="Num_tele" value="<?= $etudiant['Num_tele'] ?>">
                                </div>
                                
                                <input type="hidden" name="ID_Etud" value="<?= $etudiant['ID_Etud'] ?>">
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

