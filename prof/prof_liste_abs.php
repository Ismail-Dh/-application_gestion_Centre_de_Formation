<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les liste d'absences</h1>
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
              <li class="breadcrumb-item active">absence</li>
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
                  <th>ID_Absence</th>
                  <th>ID_Seance</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                      if (isset($_SESSION['prof_id'])) {
                        // Récupérez l'ID du professeur depuis la session
                        $professeur_id = $_SESSION['prof_id'];
                       
                        $list_query = "SELECT * FROM abscence,scences,classes,professeurs
                                     where abscence.ID_seance=scences.ID_seance and scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id'";
                         $list_result = mysqli_query($db_conn , $list_query);
         
                         while($list=mysqli_fetch_object($list_result))
                          { 

                           ?>
                        <tr>
                          <td><?=$list->ID_absc?></td>
                          <td><?=$list->ID_seance?></td>
                        </tr>
                       
                     <?php  } } ?>
                     
               </tbody>
             </table>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>