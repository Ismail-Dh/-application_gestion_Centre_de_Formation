<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Initialisation de la variable pour l'ID de l'étudiant
$etudiant_id = '';
$classe_id='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ID_Etud'])&&isset($_POST['ID_Class'])) {
        $etudiant_id = $_POST['ID_Etud'];
        $classe_id=$_POST['ID_Class'];
        // Requête pour récupérer les données de l'étudiant à modifier
        $select_query = "SELECT * FROM etudients e 
                 INNER JOIN etudiant_classe ec ON e.ID_Etud = ec.ID_Etud 
                 WHERE e.ID_Etud = $etudiant_id AND ec.ID_Class = '$classe_id'";
       // $select_query = "SELECT * FROM etudients,etudiant_classe WHERE etudients.ID_Etud = $etudiant_id and ID_Class='$classe_id'";
        
       
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
                        <h3 class="card-title">Modifier le nombre des seances payees</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="etudiant_id">ID de l'étudiant</label>
                                <input type="text" class="form-control" id="ID_Etud" name="ID_Etud" placeholder="Entrez l'ID de l'étudiant" value="<?= $etudiant_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="classe_id">ID de la classe</label>
                                <input type="text" class="form-control" id="ID_Class" name="ID_Class" placeholder="Entrez l'ID de la classe" value="<?= $classe_id ?>">
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
                        <form role="form" method="POST" action="traitement_modif_sp.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="niveau">Nombre des seances payées</label>
                                    <input type="text" class="Num_sceance_paye" id="nivea" name="Num_sceance_paye" value="<?= $etudiant['nb_seance_payee'] ?>">
                                </div>
                                
                                <input type="hidden" name="ID_Etud" value="<?= $etudiant['ID_Etud'] ?>">
                                <input type="hidden" name="ID_Class" value="<?= $etudiant['ID_Class'] ?>">
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