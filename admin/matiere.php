<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php include('sidebar.php') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les matieres</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">classes</li>
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
                <button type="button" class="btn btn-primary" onclick="location.href='ajouter_mat.php'">Ajouter une matiere</button>
                <button type="button" class="btn btn-info" onclick="location.href='modifier_mat.php'">Modifier une matiere</button>
                <button type="button" class="btn btn-danger" onclick="location.href='supprimer_mat.php'">Supprimer une matiere</button>
          </div>
        <!-- Info boxes -->
        <div class="table-responsive bg-white">
            <table class="table table-bordered border-primary">
               <thead>
                <tr>
                  <th>ID_Matiere</th>
                  <th>Nom</th>
                </tr>
               </thead>
               <tbody>
                  <?php
                      $mat_query = 'SELECT * FROM matieres';
                      $mat_result = mysqli_query($db_conn , $mat_query);
                       
                       while($mat=mysqli_fetch_object($mat_result))
                       { 

                        ?>
                     <tr>
                       <td><?=$mat->ID_Matiere?></td>
                       <td><?=$mat->nom?></td>
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