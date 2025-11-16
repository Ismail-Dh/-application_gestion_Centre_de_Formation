<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere']?? null;
  $valeur = $_POST['valeur']?? null;

 if ($critere !== null && $valeur !== null) {
  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = "SELECT * FROM etudients WHERE ";

  switch ($critere) {
      case 'id':
          $search_query .= "ID_Etud = $valeur";
          break;
      case 'nom':
          $search_query .= "Nom_Etud LIKE '$valeur%'";
          break;
      case 'niveau':
          $search_query .= "Niveau_scol = '$valeur'";
          break;
      default:
          // Critère par défaut si aucun n'est sélectionné
          $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
          break;
  }

  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $student_result = mysqli_query($db_conn, $search_query);
 } else {
  // Requête pour afficher tous les étudiants par défaut si aucun critère n'a été choisi
  $student_query = 'SELECT * FROM etudients';
  $student_result = mysqli_query($db_conn, $student_query);
 }
} else {
    // Requête pour afficher tous les étudiants par défaut si aucun formulaire n'a été soumis
    $student_query = 'SELECT * FROM etudients';
    $student_result = mysqli_query($db_conn, $student_query);
    
}

?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste Des Étudiants</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
         <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="location.href='ajouter_etud.php'">Ajouter un étudiant</button>
                <button type="button" class="btn btn-info" onclick="location.href='modeifier.php'">Modifier un étudiant</button>
                <button type="button" class="btn btn-danger" onclick="location.href='supprimer.php'">Supprimer un étudiant</button>
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
                    <option value="niveau">Niveau scolaire</option>
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
                  <th>ID-Etudiant</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Téléphone</th>
                  <th>Niveau scolaire</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($student=mysqli_fetch_object($student_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$student->ID_Etud?></td>
                       <td><?=$student->Nom_Etud?></td>
                       <td><?=$student->Prenom_Etud?></td>
                       <td><?=$student->Num_tele?></td>
                       <td><?=$student->Niveau_scol?></td>
                     </tr>
                     <?php  
                      } 
                     ?>
               </tbody>
             </table>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>