<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
<?php 
if (isset($_SESSION['prof_id'])) {
    // Récupérez l'ID du professeur depuis la session
    $professeur_id = $_SESSION['prof_id'];
   

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $critere = $_POST['critere'];
        $valeur = $_POST['valeur'];
      
        // Requête pour rechercher les étudiants selon le critère choisi
        $search_query = "SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class,scences.ID_seance,Date_seance,Numb_scence,abscence,abscence.ID_absc
                         FROM etudients,scences,liste_abscence,abscence,professeurs,classes
                         where etudients.ID_Etud = liste_abscence.ID_Etud and liste_abscence.ID_absc=abscence.ID_absc and abscence.ID_seance=scences.ID_seance and scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id'and ";
      
        switch ($critere) {
            case 'id_abs':
                $search_query .= "abscence.ID_absc = '$valeur'";
                break;
            case 'id_class':
                $search_query .= "classes.ID_Class = '$valeur'";
                break;
            case 'id_etud':
                $search_query .= "etudients.ID_Etud = '$valeur'";
                break;
            case 'id_sea':
                $search_query .= "scences.ID_seance = '$valeur'";
                break;
           case 'absc':
                  $ab='';
                  if($valeur =='oui'){
                      $ab='1';
                  }else{
                      $ab="0";
                  }
                  $search_query .= "abscence = $ab";
                  break;
            default:
                // Critère par défaut si aucun n'est sélectionné
                $search_query .= "1"; // Requête qui retourne tout si aucun critère n'est choisi
                break;
        }
      
        //echo "Requête SQL générée : " . $search_query; // Afficher la requête SQL générée
      
        $abs_result = mysqli_query($db_conn, $search_query);
      } else {
        // Requête pour afficher tous les étudiants par défaut si aucun formulaire n'a été soumis
        $abs_query = "SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class,scences.ID_seance,Date_seance,Numb_scence,abscence,abscence.ID_absc
                   FROM etudients,scences,liste_abscence,abscence,professeurs,classes
                   where etudients.ID_Etud = liste_abscence.ID_Etud and liste_abscence.ID_absc=abscence.ID_absc and abscence.ID_seance=scences.ID_seance and scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id' ";
        $abs_result = mysqli_query($db_conn, $abs_query);
        if (isset($_POST['clear_search'])) {
          
          // Requête pour afficher tous les étudiants si le bouton "Retourner au tableau initial" est cliqué
          $abs_query ="SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class,scences.ID_seance,Date_seance,Numb_scence,abscence,abscence.ID_absc
                      FROM etudients,scences,liste_abscence,abscence,professeurs,classes
                      where etudients.ID_Etud = liste_abscence.ID_Etud and liste_abscence.ID_absc=abscence.ID_absc and abscence.ID_seance=scences.ID_seance and scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof='$professeur_id'";
          $abs_result = mysqli_query($db_conn, $abs_query);
          
      }
      }
     }
?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Liste Des Abscence</h1>
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
              <li class="breadcrumb-item active">Abscence</li>
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
                <button type="button" class="btn btn-info" onclick="location.href='marquer_abs.php'">Marquer une abscence</button>
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
                    <option value="id_abs">ID liste d'abscence</option>
                    <option value="id_class">ID classe</option>
                    <option value="id_etud">ID Etudiant</option>
                    <option value="id_sea">ID Seance</option>
                    <option value="absc">Abscenter</option>
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
                  <th>ID-Abscence</th>
                  <th>ID-Classe</th>
                  <th>ID-Seance</th>
                  <th>Numero de la seance</th>
                  <th>ID-Etudiant</th>
                  <th>Nom Prénom</th>
                  <th>Date</th>
                  <th>abscence</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                       while($abs=mysqli_fetch_object($abs_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$abs->ID_absc?></td>
                       <td><?=$abs->ID_Class?></td>
                       <td><?=$abs->ID_seance?></td>
                       <td><?=$abs->Numb_scence?></td>
                       <td><?=$abs->ID_Etud?></td>
                       <td><?=$abs->Nom_Etud ." " .$abs->Prenom_Etud?></td>
                       <td><?=$abs->Date_seance?></td>
                       <td>
                          <?php 
                            if ($abs->abscence == 1) {
                              echo "oui";
                               } else {
                                   echo "non";
                             }
                         ?>
                       </td> 
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