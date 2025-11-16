<?php include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); 

// Récupérer les numéros de salle depuis la base de données
$query_salles = "SELECT numero_salle FROM salle";
$result_salles = $db_conn->query($query_salles);

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter une seance</h1>
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
                        <h3 class="card-title">Formulaire d'ajout du seance</h3>
                    </div>
                    <form role="form" method="POST" action="traitement_sea.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Sceance</label>
                                <input type="text" class="form-control" id="ID_seance" name="ID_seance" placeholder="Entrez ID">
                            </div>
                            <div class="form-group">
                                <label for="num_sea">Numero de la seance</label>
                                <input type="text" class="form-control" id="Numb_scence" name="Numb_scence" placeholder="Entrez le numero de la seance">
                            </div>
                            <div class="form-group">
                                <label for="date">Date de la seance</label>
                                <input type="text" class="form-control" id="Date_seance" name="Date_seance" placeholder="Entrez la date exemple : 2020-01-01">
                            </div>
                            <div class="form-group">
                                <label for="hd">Heure de debut </label>
                                <input type="text" class="form-control" id="heur_debut" name="heur_debut" placeholder="Entrez l'heure de debut exemple : 00:00:00">
                            </div>
                            <div class="form-group">
                                <label for="hf">Heure de fin </label>
                                <input type="text" class="form-control" id="heur_fin" name="heur_fin" placeholder="Entrez l'heure de fin exemple : 00:00:00">
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="text" class="form-control" id="prix" name="prix" placeholder="Entrez le prix ">
                            </div>
                            <div class="form-group">
                                <label for="id_class">ID de la classe </label>
                                <input type="text" class="form-control" id="ID_class" name="ID_Class" placeholder="Entrez ID de la classe ">
                            </div>
                            <div class="form-group">
                                <label for="numero_salle">Numéro de salle</label>
                                <select class="form-control" id="numero_salle" name="numero_salle">
                                    <?php
                                    if ($result_salles->num_rows > 0) {
                                        while ($row_salle = $result_salles->fetch_assoc()) {
                                            echo "<option value='" . $row_salle['numero_salle'] . "'>" . $row_salle['numero_salle'] . "</option>";
                                        }
                                    } else {
                                        echo "<option>Aucune salle disponible</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary container">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>