<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $critere = $_POST['critere']?? null;
  $valeur = $_POST['valeur']?? null;

 if ($critere !== null && $valeur !== null) {
  // Requête pour rechercher les étudiants selon le critère choisi
  $search_query = "SELECT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom_prof,prenom_prof,nom,prix,numero_salle
                   FROM scences,professeurs,classes,matieres
                   where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and ";

  switch ($critere) {
      case 'id':
          $search_query .= "ID_seance = '$valeur'";
          break;
      case 'num':
          $search_query .= " Numb_scence= '$valeur'";
          break;
      case 'id_class':
          $search_query .= "classes.ID_Class = '$valeur'";
          break;
      case 'date':
          $operateur = $_POST['operateur'];
          $search_query .= "Date_seance $operateur '$valeur'";
          break;
      default:
          // Critère par défaut si aucun n'est sélectionné
          $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
          break;
  }

 // echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée

  $sea_result = mysqli_query($db_conn, $search_query);
} else {
  // Requête pour afficher tous les seances par défaut si aucun formulaire n'a été soumis
  $sea_query = 'SELECT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom_prof,prenom_prof,nom,prix,numero_salle
                    FROM scences,professeurs,classes,matieres
                    where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere';
  $sea_result = mysqli_query($db_conn, $sea_query);
}
} else {
    
    // Requête pour afficher tous les seances si le bouton "Retourner au tableau initial" est cliqué
    $sea_query = 'SELECT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom_prof,prenom_prof,nom,prix,numero_salle
                      FROM scences,professeurs,classes,matieres
                      where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere';
    $sea_result = mysqli_query($db_conn, $sea_query);
    
}

?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste des séances</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">séances</li>
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
                <button type="button" class="btn btn-primary" onclick="location.href='ajouter_sea.php'">Ajouter une seance</button>
                <button type="button" class="btn btn-info" onclick="location.href='modifier_sea.php'">Modifier une seances</button>
                <button type="button" class="btn btn-danger" onclick="location.href='supprimer_sea.php'">Supprimer une seance</button>
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
                    <option value="id">ID_seance</option>
                    <option value="num">Numero_seance</option>
                    <option value="id_class">ID_classe</option>
                    <option value="date">Date</option>
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
                  <th>ID séance</th>
                  <th>Numero du séance</th>
                  <th>La classe</th>
                  <th>Matiere</th>
                  <th>Professeur</th>
                  <th>Date</th>
                  <th>Heure de début</th>
                  <th>Heure de fin</th>
                  <th>Prix</th>
                  <th>Salle</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($sea=mysqli_fetch_object($sea_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$sea->ID_seance?></td>
                       <td><?=$sea->Numb_scence?></td>
                       <td><?=$sea->ID_Class?></td>
                       <td><?=$sea->nom?></td>
                       <td><?=$sea->nom_prof." ".$sea->prenom_prof?></td>
                       <td><?=$sea->Date_seance?></td>
                       <td><?=$sea->heur_debut?></td>
                       <td><?=$sea->heur_fin?></td>
                       <td><?=$sea->prix?></td>
                       <td><?=$sea->numero_salle?></td>
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