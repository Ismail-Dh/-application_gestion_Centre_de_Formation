<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
            <!-- Message Start -->
            
            <!-- Message End -->
          
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a href="../logout.php" class="nav-link" title="Logout">
          logout <i class="fa fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="b.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php
// Inclure le fichier de configuration de la base de données
include('../includes/config.php');

// Démarrez la session
session_start();

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
</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Tableau de bord</p>
            </a>
          </li>
          <!-- Accounts -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                 Votre compte
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./info_prs.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Informations personnel</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Classes -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
                Votre Classes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="./prof_class.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Les classes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./prof_etudclass.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Etudiants-Classes</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Seances -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Votre Séances
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./prof_seance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Les séances</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage abscance -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
                Gestion des Absences
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./prof_liste_abs.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Les listes </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./prof_abscence.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Les abscances</p>
                </a>
              </li>
            </ul>
          </li>
        </lu>
      </nav>    
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">