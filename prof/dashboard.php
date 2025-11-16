<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

if (isset($_SESSION['prof_id'])) {
  // Récupérez l'ID du professeur depuis la session
  $professeur_id = $_SESSION['prof_id'];
// Récupération des totaux depuis la base de données
$query_students = "SELECT COUNT(*) AS total_etudiants FROM etudients,etudiant_classe,classes,professeurs
where etudients.ID_Etud = etudiant_classe.ID_Etud and etudiant_classe.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_prof= '$professeur_id'";

$query_sessions = "SELECT COUNT(*) AS total_seances FROM scences,professeurs,classes,matieres
where scences.ID_Class=classes.ID_Class and classes.ID_prof=professeurs.ID_prof and professeurs.ID_matiere=matieres.ID_Matiere and professeurs.ID_prof='$professeur_id'";

$query_classes = "SELECT COUNT(*) AS total_classes FROM professeurs, classes
where professeurs.ID_prof = classes.ID_prof  and professeurs.ID_prof = '$professeur_id'";




$result_students = $db_conn->query($query_students);

$result_sessions = $db_conn->query($query_sessions);
$result_classes = $db_conn->query($query_classes);

// Vérification et affichage des totaux
if ($result_students && $result_sessions && $result_classes ) {
    $row_etudiants = $result_students->fetch_assoc();
    $row_classes = $result_classes->fetch_assoc();
    $row_seances = $result_sessions->fetch_assoc();
   
 }
}
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php
// Inclure le fichier de configuration de la base de données


// Démarrez la session


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
?>
</a></li>
              <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de votre Étudiants</span>
                <span class="info-box-number"><?php echo $row_etudiants['total_etudiants']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de votre Séances</span>
                <span class="info-box-number"><?php echo $row_seances['total_seances']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de votre Classes</span>
                <span class="info-box-number"><?php echo $row_classes['total_classes']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>