<?php include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter un étudiant</h1>
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
                        <h3 class="card-title">Formulaire d'ajout d'étudiant</h3>
                    </div>
                    <form role="form" method="POST" action="traitement_etud.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nom">ID Etudiant</label>
                                <input type="text" class="form-control" id="ID_Etud" name="ID_Etud" placeholder="Entrez ID">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="Nom_Etud" name="Nom_Etud" placeholder="Entrez le nom">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="Prenom_Etud" name="Prenom_Etud" placeholder="Entrez le prénom">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="text" class="form-control" id="Num_tele" name="Num_tele" placeholder="Entrez le numéro de téléphone">
                            </div>
                            <div class="form-group">
                                <label for="niveau">Niveau scolaire</label>
                                <input type="text" class="form-control" id="Niveau_scol" name="Niveau_scol" placeholder="Entrez le numéro de téléphone">
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
