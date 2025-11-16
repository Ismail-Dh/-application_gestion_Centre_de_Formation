<?php
include('../includes/config.php');
include('header.php'); 
include('sidebar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'], $_POST['student_ids'])) {
    $class_id = $_POST['class_id'];
    $student_ids = $_POST['student_ids'];

    // Vérifier le nombre actuel d'étudiants dans la classe
    $count_students_query = "SELECT COUNT(*) AS count FROM etudiant_classe WHERE ID_Class = '$class_id'";
    $count_students_result = mysqli_query($db_conn, $count_students_query);
    $count_students_row = mysqli_fetch_assoc($count_students_result);

    $current_student_count = $count_students_row['count'];
    $remaining_seats = 8 - $current_student_count;

    if ($current_student_count < 8) {
        // Ajouter les étudiants à la classe avec le nombre de séances payées
        foreach ($student_ids as $student_id) {
            $seances_payees = $_POST['seances_payees_' . $student_id];
            $add_student_query = "INSERT INTO etudiant_classe (ID_Etud, ID_Class, nb_seance_payee) VALUES ('$student_id', '$class_id', '$seances_payees')";
            mysqli_query($db_conn, $add_student_query);
        }
        echo "Les étudiants ont été ajoutés avec succès à la classe.";
    } else {
        echo "La classe est pleine. Impossible d'ajouter plus d'étudiants.";
    }
}
?>

<!-- Votre formulaire d'ajout d'étudiants à une classe -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter des étudiants à une classe</h3>
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
                                        echo "</label>";
                                        echo "<br>";
                                        echo "<input type='number' name='seances_payees_" . $row['ID_Etud'] . "' placeholder='Nombre de séances payées'>";
                                        echo "<br><br>";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Ajouter des étudiants</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
