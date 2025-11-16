<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if (isset($_SESSION['etud_id'])) {
    // Récupérez l'ID du professeur depuis la session
    $etud_id = $_SESSION['etud_id'];
   
     
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $critere = $_POST['critere'];
    $valeur = $_POST['valeur'];
  
    // Requête pour rechercher les étudiants selon le critère choisi
    $search_query = "SELECT DISTINCT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom,numero_salle
                     FROM scences,etudients,etudiant_classe,classes,matieres,professeurs
                     where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and classes.ID_Class=etudiant_classe.ID_Class and etudiant_classe.ID_Etud=etudients.ID_Etud and etudients.ID_Etud='$etud_id' and ";
  
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
  
    $etud_result = mysqli_query($db_conn, $search_query);
  } else {
    // Requête pour afficher tous les seances par défaut si aucun formulaire n'a été soumis
    $etud_query = "SELECT DISTINCT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom,numero_salle
                   FROM scences,etudients,etudiant_classe,classes,matieres,professeurs
                   where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and classes.ID_Class=etudiant_classe.ID_Class and etudiant_classe.ID_Etud=etudients.ID_Etud and etudients.ID_Etud='$etud_id'";
    $etud_result = mysqli_query($db_conn, $etud_query);
    if (isset($_POST['clear_search'])) {
      
      // Requête pour afficher tous les seances si le bouton "Retourner au tableau initial" est cliqué
      $etud_query = "SELECT DISTINCT ID_seance,Numb_scence,Date_seance,heur_debut,heur_fin,classes.ID_Class,nom,numero_salle
                     FROM scences,etudients,etudiant_classe,classes,matieres,professeurs
                    where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and classes.ID_Class=etudiant_classe.ID_Class and etudiant_classe.ID_Etud=etudients.ID_Etud and etudients.ID_Etud='$etud_id'";
      $etud_result = mysqli_query($db_conn, $etud_query);
      
  }
  }
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
                  <th>Date</th>
                  <th>Heure de début</th>
                  <th>Heure de fin</th>
                  <th>Salle</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($etud=mysqli_fetch_object($etud_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$etud->ID_seance?></td>
                       <td><?=$etud->Numb_scence?></td>
                       <td><?=$etud->ID_Class?></td>
                       <td><?=$etud->nom?></td>
                       <td><?=$etud->Date_seance?></td>
                       <td><?=$etud->heur_debut?></td>
                       <td><?=$etud->heur_fin?></td>
                       <td><?=$etud->numero_salle?></td>
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