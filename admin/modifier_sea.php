<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de seance
$sea_id='';
$sea = []; // Initialisation du tableau des données de la séance



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID_seance'])) {
    $sea_id = $_POST['ID_seance'];

    $select_query = "SELECT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom_prof,prenom_prof,nom,prix,numero_salle
                     FROM scences,professeurs,classes,matieres
                     where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and ID_seance = '$sea_id' ";
    $result = mysqli_query($db_conn, $select_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $sea = mysqli_fetch_assoc($result);
    } else {
        echo "Aucun professeur trouvé avec cet ID.";
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
                        <h3 class="card-title">Modifier une seance</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="sea_id">ID de seance</label>
                                <input type="text" class="form-control" id="ID_seance" name="ID_seance" placeholder="Entrez l'ID du seance" value="<?= $sea_id ?>">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Charger la seance</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($sea) && !empty($sea)) { ?>
                    <!-- Formulaire de modification avec les données du seance chargées -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Modifier les informations du seance</h3>
                        </div>
                        <form role="form" method="POST" action="traitement_modif_sea.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="numb">Numero de la seance</label>
                                    <input type="text" class="form-control" id="Numb_scence" name="Numb_scence" value="<?= $sea['Numb_scence'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control" id="Date_seance" name="Date_seance" value="<?= $sea['Date_seance'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hd">Heure de debut</label>
                                    <input type="text" class="form-control" id="heur_debut"  name="heur_debut" value="<?= $sea['heur_debut'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="hf">Heure de fin</label>
                                    <input type="text" class="form-control" id="adresse" name="heur_fin" value="<?= $sea['heur_fin'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="ID_classe">ID classe</label>
                                    <input type="text" class="from-control" id="ID_Class" name="ID_Class" value="<?= $sea['ID_Class'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="prix">Prix</label>
                                    <input type="text" class="from-control" id="prix" name="prix" value="<?= $sea['prix'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="salle">Salle</label>
                                    <input type="text" class="from-control" id="numero_salle" name="numero_salle" value="<?= $sea['numero_salle'] ?>">
                                </div>
                                
                                <input type="hidden" name="ID_seance" value="<?= $sea['ID_seance'] ?>">
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