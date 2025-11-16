<?php include('../includes/config.php'); ?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ajouter une classe</h1>
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
                        <h3 class="card-title">Formulaire d'ajout de la classe</h3>
                    </div>
                    <form role="form" method="POST" action="traitement_class.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id">ID Classes</label>
                                <input type="text" class="form-control" id="ID_Class" name="ID_Class" placeholder="Entrez ID">
                            </div>
                            <div class="form-group">
                                <label for="type">Type de fonction </label>
                                <input type="text" class="form-control" id="type_fonction" name="type_fonction" placeholder="Entrez le type">
                            </div>
                            <div class="form-group">
                                <label for="id_prof">ID de professeur</label>
                                <input type="text" class="form-control" id="ID_prof" name="ID_prof" placeholder="Entrez le ID de le professeur">
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