<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if (isset($_SESSION['prof_id'])) {
 // Récupérez l'ID du professeur depuis la session
 $professeur_id = $_SESSION['prof_id'];

  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = "SELECT ID_prof, nom_prof, prenom_prof, adresse, telephone, nom 
                   FROM professeurs, matieres
                   where professeurs.ID_matiere = matieres.ID_Matiere  and ID_prof = '$professeur_id' ";



  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $prof_result = mysqli_query($db_conn, $search_query);
} 
?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MES INFORMATIONS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php

// Vérifiez si l'ID du professeur est disponible dans la session
if (isset($_SESSION['prof_id'])) {
    // Récupérez l'ID du professeur depuis la session
    $professeur_id = $_SESSION['prof_id'];

    // Requête SQL pour récupérer le nom et le prénom du professeur à partir de son ID
    $query = "SELECT nom_prof, prenom_prof FROM professeurs WHERE ID_prof = '$professeur_id'";
    $result = mysqli_query($db_conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Récupérez les données du professeur
        $professeur = mysqli_fetch_assoc($result);

        // Affichez le nom et le prénom du professeur
        echo $professeur['nom_prof'] . " " . $professeur['prenom_prof'];
    } else {
        // Si aucun résultat n'est trouvé
        echo "Nom du Professeur";
    }
} else {
    // Si l'ID du professeur n'est pas disponible dans la session
    echo "Nom du Professeur";
}
?></a></li>
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