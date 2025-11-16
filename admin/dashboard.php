<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

// Connexion à la base de données
//$db_conn = new mysqli('localhost', 'nom_utilisateur', 'mot_de_passe', 'nom_base_de_données');

// Vérifier la connexion à la base de données
if ($db_conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $db_conn->connect_error);
}

// Fonction pour vérifier la disponibilité des salles pour une classe à une heure donnée
function salleDisponibleAvecClasse($date_seance, $heure_debut, $heure_fin, $numero_salle, $db_conn)
{
    $query = "SELECT COUNT(*) AS count_seances,ID_Class
              FROM scences 
              WHERE Date_seance = '$date_seance'
              AND (heur_debut = '$heure_debut' AND heur_fin = '$heure_fin')
              AND numero_salle = '$numero_salle'";
             
              
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();
    if ($row['count_seances'] > 0) {
      return $row['ID_Class']; // Retourne l'ID de la classe si la salle est occupée
    } else {
      return false; // Retourne false si la salle est disponible
    }
}

// Récupération des dates depuis la base de données
$query_dates = "SELECT DISTINCT Date_seance FROM scences"; // Changer 'scences' par le nom de votre table

// Exécution de la requête
$result_dates = $db_conn->query($query_dates);

// Vérification des résultats et stockage des dates dans un tableau
$datesFromDatabase = [];
if ($result_dates->num_rows > 0) {
    while ($row = $result_dates->fetch_assoc()) {
        $datesFromDatabase[] = $row['Date_seance'];
    }
}

// Liste ordonnée des tranches horaires
$tranches = array("18:00 - 20:00", "20:00 - 22:00");

// Récupération des dates de la semaine actuelle
$today = date("Y-m-d"); // Date actuelle
$dayOfWeek = date("N", strtotime($today)); // Jour de la semaine (1 pour lundi, 2 pour mardi, ..., 7 pour dimanche)
$weekStart = date("Y-m-d", strtotime('-' . ($dayOfWeek - 1) . ' days', strtotime($today))); // Début de la semaine
$weekEnd = date("Y-m-d", strtotime('+' . (7 - $dayOfWeek) . ' days', strtotime($today))); // Fin de la semaine

$datesFromDatabase = array(); // Utilisé pour les dates récupérées depuis la base de données



// Récupération des totaux depuis la base de données
$query_students = "SELECT COUNT(*) AS total_etudiants FROM etudients";
$query_professors = "SELECT COUNT(*) AS total_professeurs FROM professeurs";
$query_sessions = "SELECT COUNT(*) AS total_seances FROM scences";
$query_subjects = "SELECT COUNT(*) AS total_matieres FROM matieres";
$query_classes = "SELECT COUNT(*) AS total_classes FROM classes";

$result_students = $db_conn->query($query_students);
$result_professors = $db_conn->query($query_professors);
$result_sessions = $db_conn->query($query_sessions);
$result_subjects = $db_conn->query($query_subjects);
$result_classes = $db_conn->query($query_classes);
// Vérification et affichage des totaux
if ($result_students && $result_professors && $result_sessions && $result_subjects && $result_classes) {
    $row_etudiants = $result_students->fetch_assoc();
    $row_professeurs = $result_professors->fetch_assoc();
    $row_seances = $result_sessions->fetch_assoc();
    $row_matieres = $result_subjects->fetch_assoc();
    $row_classes = $result_classes->fetch_assoc();
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
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
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
                <span class="info-box-text">Total Étudiants</span>
                <span class="info-box-number"><?php echo $row_etudiants['total_etudiants']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Professeurs</span>
                <span class="info-box-number"><?php echo $row_professeurs['total_professeurs']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-school"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Séances</span>
                <span class="info-box-number"><?php echo $row_seances['total_seances']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Matières</span>
                <span class="info-box-number"><?php echo $row_matieres['total_matieres']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chalkboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Classes</span>
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
   

 <!-- Tableau -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Planning des Salles</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th><!-- Espace pour les jours -->
                                    <?php for ($i = 1; $i <= 9; $i++) { ?>
                                        <th>Salle <?php echo $i; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Boucle pour afficher les jours de la semaine actuelle
                                $date = $weekStart;
                                while (strtotime($date) <= strtotime($weekEnd)) {
                                    ?>
                                    <tr>
                                        <td><?php echo date("Y-m-d", strtotime($date)); ?><br/><?php echo $tranches[0]; ?></td>
                                        <?php
                                        for ($k = 0; $k < 9; $k++) {
                                            ?>
                                            <td>
                                                <?php 
                                                $id_classe = salleDisponibleAvecClasse($date, '18:00:00', '20:00:00', "Salle " . ($k + 1), $db_conn);
                                                if ($id_classe) {
                                                    echo "<span style='color:red;'>Occupée <br>ID Classe: $id_classe</span>";
                                                } else {
                                                    echo "<span style='color:white;'>Disponible</span>";
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td><?php echo date("Y-m-d", strtotime($date)); ?><br/><?php echo $tranches[1]; ?></td>
                                        <?php
                                        for ($k = 0; $k < 9; $k++) {
                                            ?>
                                            <td>
                                                <?php 
                                                $id_classe = salleDisponibleAvecClasse($date, '20:00:00', '22:00:00', "Salle " . ($k + 1), $db_conn);
                                                if ($id_classe) {
                                                    echo "<span style='color:red;'>Occupée <br>ID Classe: $id_classe</span>";
                                                } else {
                                                    echo "<span style='color:white;'>Disponible</span>";
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $date = date("Y-m-d", strtotime('+1 day', strtotime($date))); // Passer au jour suivant
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php include('footer.php') ?>