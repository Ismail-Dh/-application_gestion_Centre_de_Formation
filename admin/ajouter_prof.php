<?php include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter un professeur</h1>
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
                        <h3 class="card-title">Formulaire d'ajout du professeur</h3>
                    </div>
                    <form role="form" method="POST" action="traitement_prof.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nom">ID Professeur</label>
                                <input type="text" class="form-control" id="ID_prof" name="ID_prof" placeholder="Entrez ID">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom_prof" name="nom_prof" placeholder="Entrez le nom">
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="prenom_prof" name="prenom_prof" placeholder="Entrez le prénom">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrez le numéro de téléphone">
                            </div>
                            <div class="form-group">
                                <label for="adresse">L'adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez l'adresse">
                            </div>
                            <div class="form-group">
                                <label for="ID_matiere">ID Matiere</label>
                                <input type="text" class="form-control" id="ID_matiere" name="ID_matiere" placeholder="Entrez ID de la matiere ">
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