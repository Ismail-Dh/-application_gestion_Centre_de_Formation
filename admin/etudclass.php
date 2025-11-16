<?php include('../includes/config.php') ;
include('header.php') ;
include('sidebar.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere']?? null;
  $valeur = $_POST['valeur']?? null;

 if ($critere !== null && $valeur !== null) {
  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = 'SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,ID_Class,nb_abs,nb_seance_payee
                  FROM etudients,etudiant_classe
                  where etudients.ID_Etud = etudiant_classe.ID_Etud and ';

  switch ($critere) {
      case 'ID_Etud':
          $search_query .= "etudients.ID_Etud = '$valeur'";
          break;
      case 'ID_Class':
          $search_query .= "ID_Class = '$valeur'";
          break;
      case 'seances':
            $operateur = $_POST['operateur'];
            $search_query .= "nb_seance_payee $operateur $valeur";
            break;
      default:
          // Critère par défaut si aucun n'est sélectionné
          $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
          break;
  }

  //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $etudclass_result = mysqli_query($db_conn, $search_query);
} else {
  // Requête pour afficher tous les professeurs par défaut si aucun formulaire n'a été soumis
  $etudclass_query = 'SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,ID_Class,nb_abs,nb_seance_payee
                      FROM etudients,etudiant_classe
                      where etudients.ID_Etud = etudiant_classe.ID_Etud 
                      ORDER BY ID_Class';
  $etudclass_result = mysqli_query($db_conn, $etudclass_query);
}
} else { 
    // Requête pour afficher tous les professeurs si le bouton "Retourner au tableau initial" est cliqué
    $etudclass_query = 'SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,ID_Class,nb_abs,nb_seance_payee
                      FROM etudients,etudiant_classe
                      where etudients.ID_Etud = etudiant_classe.ID_Etud 
                      ORDER BY ID_Class';
   $etudclass_result = mysqli_query($db_conn, $etudclass_query);
    
}

?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les Groupes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">groupes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Ajout du bouton "Ajouter des étudiants à une classe" -->
   
 <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="mb-3">
          <button class="btn btn-primary" onclick="window.location.href='ajouter_etud_class.php'">Ajouter des étudiants à un groupe</button>
          <button type="button" class="btn btn-info" onclick="location.href='modeifier_sp.php'">Modifier le nombre des seances payees</button>
          <button type="button" class="btn btn-danger" onclick="location.href='supprimer_etud_class.php'">Supprimer des étudiants depuis un groupe</button>
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
                    <option value="ID_Etud">ID_Etudiant</option>
                    <option value="ID_Class">ID_Classe</option>
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
                  <th>ID_Etudiant</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>ID-Classe</th>
                  <th>Nombre des seances payées</th>
                  <th>Nombre d'absence</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($etudclass=mysqli_fetch_object($etudclass_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$etudclass->ID_Etud?></td>
                       <td><?=$etudclass->Nom_Etud?></td>
                       <td><?=$etudclass->Prenom_Etud?></td>
                       <td><?=$etudclass->ID_Class?></td>
                       <td><?=$etudclass->nb_seance_payee?></td>
                       <td><?=$etudclass->nb_abs?></td>
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