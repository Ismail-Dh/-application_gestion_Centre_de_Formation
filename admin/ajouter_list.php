<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php
    include('../includes/config.php');

    // Récupération des options pour le champ ID de séance depuis la base de données
    $seance_query = "SELECT ID_seance FROM scences"; 
    $seance_result = mysqli_query($db_conn, $seance_query);

    // Stockage des options dans un tableau
    $seance_options = [];
    while ($row = mysqli_fetch_assoc($seance_result)) {
        $seance_options[] = $row['ID_seance'];
    }

    // Vérification si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire, assurez-vous de nettoyer et valider les entrées utilisateur pour des raisons de sécurité
        $id_absence = $_POST['id_absence']; // Champ pour l'ID d'absence
        $id_seance = $_POST['id_seance']; // Champ pour l'ID de séance

        // Requête d'insertion dans la base de données
        $insert_query = "INSERT INTO abscence (ID_absc, ID_seance) VALUES ('$id_absence', '$id_seance')";

        // Exécution de la requête
        if (mysqli_query($db_conn, $insert_query)) {
            // Redirection vers une page après l'ajout réussi
            header("Location: liste_abs.php");
            exit();
        } else {
            // Gestion des erreurs lors de l'insertion
            echo "Erreur lors de l'ajout : " . mysqli_error($db_conn);
        }
    }
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter une liste</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulaire d'ajout du liste d'absence</h3>
                    </div>
                    <form method="post" action="traitement_ajout_list.php">
                      <div class="card-body">
                          <div class="form-group">
                              <!-- Champ pour saisir l'ID de l'absence -->
                              <label for="id_absence">ID de l'absence :</label>
                              <input type="text" id="id_absence" name="id_absence" required><br><br>                          
                          </div>
                          <div class="from-group">
                             <!-- Menu déroulant pour les options de l'ID de séance -->
                             <label for="id_seance">Choisir une séance :</label>
                             <select id="id_seance" name="id_seance" required>
                                <?php foreach ($seance_options as $option) { ?>
                                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                 <?php } ?>
                             </select><br><br>

                       <input type="submit" value="Ajouter">
                     </form>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>