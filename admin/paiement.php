<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere'] ?? null;
  $valeur = $_POST['valeur'] ?? null;

  if ($critere !== null && $valeur !== null) {
    $search_query = "SELECT *
                     FROM etudients, etudiant_classe
                     WHERE etudients.ID_Etud = etudiant_classe.ID_Etud AND nb_seance_payee <= 1 AND ";

    switch ($critere) {
        case 'id':
            $search_query .= "etudients.ID_Etud = '$valeur'";
            break;
        case 'idc':
              $search_query .= "ID_Class = '$valeur'";
              break;
        case 'nom':
            $search_query .= "Nom_Etud LIKE '$valeur%'";
            break;
        case 'seances':
            $operateur = $_POST['operateur'];
            $search_query .= "nb_seance_payee $operateur $valeur";
            break;
        default:
            $search_query .= "1";
            break;
    }

    $student_result = mysqli_query($db_conn, $search_query);
  } else {
    // Requête pour afficher tous les étudiants par défaut si aucun critère n'a été choisi
    $student_query = 'SELECT * FROM etudients, etudiant_classe WHERE etudients.ID_Etud = etudiant_classe.ID_Etud AND nb_seance_payee <= 1';
    $student_result = mysqli_query($db_conn, $student_query);
  }
} else {
  // Requête pour afficher tous les étudiants par défaut si aucun formulaire n'a été soumis
  $student_query = 'SELECT * FROM etudients, etudiant_classe WHERE etudients.ID_Etud = etudiant_classe.ID_Etud AND nb_seance_payee <= 1';
  $student_result = mysqli_query($db_conn, $student_query);
}
?>

<!-- Le reste de votre code HTML pour afficher les résultats -->


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
                    <option value="id">ID_Etudiant</option>
                    <option value="idc">ID_Classe</option>
                    <option value="nom">Nom</option>
                    <option value="seances">Nombre de séances payées</option>
                </select>
                <input type="text" name="valeur" placeholder="Valeur de recherche">
                <select name="operateur">
                    <option value="=">Equal (=)</option>
                    <option value="<">Less than (<)</option>
                    <option value=">">Greater than (>)</option>
                    <option value="<=">Less than or equal (<=)</option>
                    <option value=">=">Greater than or equal (>=)</option>
                </select>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>

        <!-- Info boxes -->
        <div class="table-responsive bg-white">
            <table class="table table-bordered border-primary">
               <thead>
                <tr>
                  <th>ID-Classe</th>
                  <th>ID-Etudiant</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>les séances payes</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($student=mysqli_fetch_object($student_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$student->ID_Class?></td>
                       <td><?=$student->ID_Etud?></td>
                       <td><?=$student->Nom_Etud?></td>
                       <td><?=$student->Prenom_Etud?></td>
                       <td><?=$student->nb_seance_payee?></td>
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