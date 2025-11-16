<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

$prof_id = '';
$prof = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_prof'])) {
    $prof_id = $_POST['ID_prof'];

    $select_query = "SELECT * FROM professeurs WHERE ID_prof = '$prof_id' ";
    $result = mysqli_query($db_conn, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $prof = mysqli_fetch_assoc($result);
    } else {
        echo "Aucun professeur trouvé avec cet ID.";
    }

}
?>

<!-- Votre contenu HTML pour l'en-tête -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Modifier un professeur</h3>
                    </div>
                    <form role="form" method="POST" action="modifier_prof.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="prof_id">ID de professeur</label>
                                <input type="text" class="form-control" id="ID_prof" name="ID_prof" placeholder="Entrez l'ID du professeur" value="<?= $prof_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger le professeur</button>
                        </div>
                    </form>
                </div>
                <?php if (!empty($prof)) { ?>
                    <!-- Formulaire de modification avec les données du professeur chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations du professeur</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_prof.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nom_prof">Nom</label>
                                    <input type="text" class="form-control" id="nom_prof" name="nom_prof" value="<?= $prof['nom_prof'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prenom_prof">Prénom</label>
                                    <input type="text" class="form-control" id="prenom_prof" name="prenom_prof" value="<?= $prof['prenom_prof'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Téléphone</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $prof['telephone'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?= $prof['adresse'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ID_matiere">ID matière</label>
                                    <input type="text" class="form-control" id="ID_matiere" name="ID_matiere" value="<?= $prof['ID_matiere'] ?>">
                                </div>
                                <input type="hidden" name="ID_prof" value="<?= $prof['ID_prof'] ?>">
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

