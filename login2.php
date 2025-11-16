<?php include('header.php') ?>

<section class="d-flex justify-content-center align-items-center" style="height: 100vh; background-image: url('fff.jpg'); background-size: cover; background-position: center;">
  <div class="col-3">
    <div class="card" style="background-color: rgba(255, 255, 255, 0.7);">
      <div class="card-body">
        <div class="border rounded-circle mx-auto d-flex" style="width:100px;height:100px ; background-color: rgba(255, 255, 255, 0.5);"><i class="fa fa-user text-light fa-3x m-auto"></i></div>
        <form action="actions/login2.php" method="POST">
          <div class="md-form">
            <input type="text" id="nom" name="nom" class="form-control" style="background-color: rgba(255, 255, 255, 0.5);">
            <label for="nom">Votre Nom</label>
          </div>
          <div class="md-form">
            <input type="password" id="password" name="id" class="form-control" style="background-color: rgba(255, 255, 255, 0.5);">
            <label for="password">Votre ID</label>
          </div>
          <div class="text-center">
            <button class="btn btn-primary" name="login2">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php') ?>