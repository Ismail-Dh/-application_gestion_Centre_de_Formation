<?php include('../includes/config.php') ;
include('header.php') ;
include('sidebar.php');
if (isset($_SESSION['prof_id'])) {
    // Récupérez l'ID du professeur depuis la session
    $professeur_id = $_SESSION['prof_id'];
   
     
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $critere = $_POST['critere'];
    $valeur = $_POST['valeur'];
  
    // Requête pour rechercher les étudiants selon le critère choisi
    $search_query = "SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class
                    FROM etudients,etudiant_classe,classes,professeurs
                    where etudients.ID_Etud = etudiant_classe.ID_Etud and etudiant_classe.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof= '$professeur_id' and ";
  
    switch ($critere) {
        case 'ID_Etud':
            $search_query .= "etudients.ID_Etud = '$valeur'";
            break;
        case 'ID_Class':
            $search_query .= "classes.ID_Class = '$valeur'";
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
    $etudclass_query = "SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class
                        FROM etudients,etudiant_classe,classes,professeurs
                        where etudients.ID_Etud = etudiant_classe.ID_Etud and etudiant_classe.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof= '$professeur_id' ";
    $etudclass_result = mysqli_query($db_conn, $etudclass_query);
    if (isset($_POST['clear_search'])) {
      // Requête pour afficher tous les professeurs si le bouton "Retourner au tableau initial" est cliqué
      $etudclass_query = "SELECT etudients.ID_Etud,Nom_Etud,Prenom_Etud,classes.ID_Class
                        FROM etudients,etudiant_classe,classes,professeurs
                        where etudients.ID_Etud = etudiant_classe.ID_Etud and etudiant_classe.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof= '$professeur_id'";
     $etudclass_result = mysqli_query($db_conn, $etudclass_query);
      
  }
  }
}
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les classes</h1>
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
              <li class="breadcrumb-item active">classes</li>
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
                  <th>ID_Etudiant</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>ID-Classe</th>
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