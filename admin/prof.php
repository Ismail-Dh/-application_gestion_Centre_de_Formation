<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere']?? null;
  $valeur = $_POST['valeur']?? null;
 if ($critere !== null && $valeur !== null) {
  // Requête pour rechercher les professeurs selon le critère choisi
  $search_query = "SELECT ID_prof, nom_prof, prenom_prof, adresse, telephone, nom 
                   FROM professeurs, matieres
                   where professeurs.ID_matiere = matieres.ID_Matiere and ";

  switch ($critere) {
      case 'id':
          $search_query .= "ID_prof = '$valeur'";
          break;
      case 'nom':
          $search_query .= "nom_prof LIKE '$valeur%'";
          break;
      case 'nom_matiere':
          $search_query .= "matieres.nom = '$valeur'";
          break;
      case 'adresse':
          $search_query .= "adresse ='$valeur'";
          break;
      default:
          // Critère par défaut si aucun n'est sélectionné
          $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
          break;
  }

  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $prof_result = mysqli_query($db_conn, $search_query);
 } else {
  // Requête pour afficher tous les professeurs par défaut si aucun formulaire n'a été soumis
  $prof_query = 'SELECT ID_prof, nom_prof, prenom_prof, adresse, telephone, nom 
                 FROM professeurs, matieres
                 where professeurs.ID_matiere = matieres.ID_Matiere';
  $prof_result = mysqli_query($db_conn, $prof_query);
 }
} else {
    
    // Requête pour afficher tous les professeurs si le bouton "Retourner au tableau initial" est cliqué
    $prof_query = "SELECT ID_prof, nom_prof, prenom_prof, adresse, telephone, nom 
                   FROM professeurs, matieres
                   where professeurs.ID_matiere = matieres.ID_Matiere";
    $prof_result = mysqli_query($db_conn, $prof_query);
    
}

?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste Des Professeurs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Professeurs</li>
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
                <button type="button" class="btn btn-primary" onclick="location.href='ajouter_prof.php'">Ajouter un professeur</button>
                <button type="button" class="btn btn-info" onclick="location.href='modifier_prof.php'">Modifier un professeur</button>
                <button type="button" class="btn btn-danger" onclick="location.href='supprimer_prof.php'">Supprimer un professeur</button>
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
                    <option value="nom">Nom</option>
                    <option value="nom_matiere">la matiere</option>
                    <option value="adresse">L'adresse</option>
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
                  <th>ID-Professeur</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Téléphone</th>
                  <th>Adresse</th>
                  <th>Matiere</th>
                </tr>
               </thead>
               <tbody>
               <?php
                    
                    while ($prof = mysqli_fetch_object($prof_result)) {
                    ?>
                     <tr>
                        <td><?= $prof->ID_prof ?></td>
                        <td><?= $prof->nom_prof ?></td>
                        <td><?= $prof->prenom_prof ?></td>
                        <td><?= $prof->telephone ?></td>
                        <td><?= $prof->adresse ?></td>
                        <td><?= $prof->nom?></td>
                     </tr>
                    <?php } ?>
               </tbody>
             </table>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>