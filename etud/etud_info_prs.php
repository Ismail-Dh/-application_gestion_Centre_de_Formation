<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if (isset($_SESSION['etud_id'])) {
 // Récupérez l'ID du professeur depuis la session
 $etud_id = $_SESSION['etud_id'];

  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = "SELECT ID_Etud, Nom_Etud, Prenom_Etud,Num_tele,Niveau_scol	
                   FROM etudients
                   where  ID_Etud = '$etud_id' ";



  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $etud_result = mysqli_query($db_conn, $search_query);
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
if (isset($_SESSION['etud_id'])) {
    // Récupérez l'ID du professeur depuis la session
    $etud_id = $_SESSION['etud_id'];

    // Requête SQL pour récupérer le nom et le prénom du professeur à partir de son ID
    $query = "SELECT Nom_Etud, Prenom_Etud FROM etudients WHERE ID_Etud = '$etud_id'";
    $result = mysqli_query($db_conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Récupérez les données du professeur
        $etud = mysqli_fetch_assoc($result);

        // Affichez le nom et le prénom du professeur
        echo $etud['Nom_Etud'] . " " . $etud['Prenom_Etud'];
    } else {
        // Si aucun résultat n'est trouvé
        echo "Nom d'etudiant";
    }
} else {
    // Si l'ID du professeur n'est pas disponible dans la session
    echo "Nom d'etudiant";
}
?></a></li>
              <li class="breadcrumb-item active">Etudiants</li>
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
                  <th>ID-Etudiant</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Téléphone</th>
                  <th>Niveau scolaire</th>
                </tr>
               </thead>
               <tbody>
               <?php
                    
                    while ($etud = mysqli_fetch_object($etud_result)) {
                    ?>
                     <tr>
                        <td><?= $etud->ID_Etud ?></td>
                        <td><?= $etud->Nom_Etud?></td>
                        <td><?= $etud->Prenom_Etud ?></td>
                        <td><?= $etud->Num_tele ?></td>
                        <td><?= $etud->Niveau_scol ?></td>
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