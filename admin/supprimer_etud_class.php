<?php
include('../includes/config.php');
include('header.php');
include('sidebar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'], $_POST['student_ids'])) {
    $class_id = $_POST['class_id'];
    $student_ids = $_POST['student_ids'];

    // Supprimer les étudiants de la classe
    foreach ($student_ids as $student_id) {
        $delete_student_query = "DELETE FROM etudiant_classe WHERE ID_Etud = '$student_id' AND ID_Class = '$class_id'";
        mysqli_query($db_conn, $delete_student_query);
    }

    echo "Les étudiants ont été supprimés de la classe avec succès.";
}
?>
<!-- Votre formulaire de supprimer d'étudiants à une classe -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Supprimer des étudiants à une classe</h3>
                    </div>
                    <form role="form" method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="class_id">Sélectionnez une classe :</label>
                                <select class="form-control" id="class_id" name="class_id">
                                   <?php
                                     $class_query = "SELECT ID_Class, type_fonction FROM classes";
                                     $class_result = mysqli_query($db_conn, $class_query);

                                     while ($row = mysqli_fetch_assoc($class_result)) {
                                         // echo "<option value='" . $row['ID_Class'] . "'>" . $row['type_fonction'] . "</option>";
                                          echo "<option value='" . $row['ID_Class'] . "'>ID: " . $row['ID_Class'] . " - " . $row['type_fonction'] . "</option>";
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="student_ids">Sélectionnez des étudiants :</label><br>
                                <?php
                                $student_query = "SELECT ID_Etud, Nom_Etud, Prenom_Etud FROM etudients";
                                $student_result = mysqli_query($db_conn, $student_query);

                                while ($row = mysqli_fetch_assoc($student_result)) {
                                    echo "<label>";
                                    echo "<input type='checkbox' name='student_ids[]' value='" . $row['ID_Etud'] . "'>";
                                    echo $row['Nom_Etud'] . " " . $row['Prenom_Etud'];
                                    echo "</label><br>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Supprimer des étudiants</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>