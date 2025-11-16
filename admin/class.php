<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere']?? null;
  $valeur = $_POST['valeur']?? null;
 if ($critere !== null && $valeur !== null) {
  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = "SELECT ID_Class,type_fonction,nom ,nom_prof,prenom_prof
                  FROM classes, professeurs ,matieres
                  where classes.ID_prof = professeurs.ID_prof and professeurs.ID_matiere = matieres.ID_Matiere and ";
 

  switch ($critere) {
      case 'id':
          $search_query .= "ID_Class = '$valeur'";
          break;
      case 'type':
          $search_query .= "type_fonction LIKE '$valeur%'";
          break;
      case 'ID_matiere':
          $search_query .= "matieres.nom = '$valeur'";
          break;
      default:
          // Critère par défaut si aucun n'est sélectionné
          $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
          break;
  }
 
  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $class_result = mysqli_query($db_conn, $search_query);
} else {
  // Requête pour afficher tous les professeurs par défaut si aucun formulaire n'a été soumis
  $class_query = 'SELECT ID_Class, type_fonction, nom ,nom_prof,prenom_prof
                 FROM professeurs, matieres,classes
                 where professeurs.ID_matiere = matieres.ID_Matiere and classes.ID_prof = professeurs.ID_prof ';
  $class_result = mysqli_query($db_conn, $class_query);
}
} else {
    // Requête pour afficher tous les professeurs si le bouton "Retourner au tableau initial" est cliqué
    $class_query = 'SELECT ID_Class, type_fonction, nom ,nom_prof ,prenom_prof
                    FROM professeurs, classes,matieres
                    where professeurs.ID_matiere = matieres.ID_Matiere and classes.ID_prof = professeurs.ID_prof ';
    $class_result = mysqli_query($db_conn, $class_query);
    
}

?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste Des Classes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Classes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
           <!-- Buttons -->
         <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="location.href='ajouter_class.php'">Ajouter une classe</button>
                <button type="button" class="btn btn-info" onclick="location.href='modifier_class.php'">Modifier une classe </button>
                <button type="button" class="btn btn-danger" onclick="location.href='supprimer_class.php'">Supprimer une classe</button>
          </div>
             <!-- Bouton pour revenir au tableau initial -->
            <div class="mb-3">
             <form method="POST" action="">
                <input type="hidden" name="clear_search" value="true">
                <button type="submit" class="btn btn-secondary">Retourner au tableau initiale</button>
             </form>
            </div>

             <!-- Formulaire de recherche -->
        <div class="mb-3">
            <form method="POST" action="">
                <label for="critere">Choisissez un critère :</label>
                <select id="critere" name="critere">
                    <option value="id">ID</option>
                    <option value="type">Nom</option>
                    <option value="ID_matiere">la matiere</option>
                </select>
                <input type="text" name="valeur" placeholder="Valeur de recherche">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
        <!-- Info boxes -->
        <div class="table-responsive bg-white">
            <table class="table table-bordered border-primary">
               <thead>
                <tr>
                  <th>ID-Classes</th>
                  <th>Type de fonction</th>
                  <th>Matiere</th>
                  <th>Professeur</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($class=mysqli_fetch_object($class_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$class->ID_Class?></td>
                       <td><?=$class->type_fonction?></td>
                       <td><?=$class->nom?></td>
                       <td><?=$class->nom_prof ." ".$class->prenom_prof?></td>
                     </tr>
                     <?php  } ?>
               </tbody>
             </table>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>