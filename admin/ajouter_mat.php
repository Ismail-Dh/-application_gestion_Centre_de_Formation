<?php include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter une matiere</h1>
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
                        <h3 class="card-title">Formulaire d'ajout de la matiere</h3>
                    </div>
                    <form role="form" method="POST" action="traitement_mat.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Matiere</label>
                                <input type="text" class="form-control" id="ID_Matiere" name="ID_Matiere" placeholder="Entrez ID">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom </label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de la matiere">
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