<?php include('header.php') ?>

  <section class="sec1">
     <div class="d">
      <header>
        <!-- Logo -->
        <!-- Logo -->
        <div class="logo">
           <img src="WhatsApp_Image_2023-12-03_à_17.41.51_9f13bc6f-removebg-preview.png" alt="Logo">
        </div>
        <!-- Menu -->
        <div class="content"> 
           <h1 class="h"> Excellency&<span>Hub</span><br>Centre de Formation</h1>
           <p class="par">
           Notre centre de formation offre de nombreux avantages<br>
           pour les étudiants souhaitant approfondir leur connaissances,<br>
           et améliorer leurs compétences académiques.</p>
         </div> 
       <!-- Menu -->
       <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#sec2">Notre service</a></li>
            <li><a href="#vous">Vous êtes</a></li>
            <li><a href="login.php">Administration</a></li>
            <li><a href="login1.php">Enseignement</a></li>
            <li><a href="login2.php">Étudiant</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
       </nav>
      </header>
    </div>
  </section>
  <section id="sec2" class="py-5 sec2">
       <h1 class="mt-5 text-center font-weight-bold"> NOTRE SERVICE </h1>
          <div class="container-fluid">
             <div class="row">
               <div class="col-12">
                 <p class="text-justify">Notre centre de formation est un véritable creuset du savoir, 
                    offrant un soutien académique solide tant dans les langues que dans le domaine de l'informatique. 
                    Nous croyons fermement que l'éducation est la clé du succès, c'est pourquoi nous mettons tout en œuvre
                    pour fournir des cours de qualité, adaptés aux besoins individuels de chaque étudiant. Que ce soit pour
                    perfectionner ses compétences linguistiques ou pour acquérir une expertise pointue en informatique,
                    notre équipe pédagogique dévouée et nos programmes bien structurés garantissent un apprentissage 
                    enrichissant et une préparation optimale pour le monde professionnel.
                 </p>
                </div>
             </div>
           </div>
         <div class="d-flex flex-row justify-content-center">
             <div class="col-lg-3 m-5">
                <div class="card">
                    <img src="OIP.jpeg" alt="" class="img-fluid rounded-top">
                      <div class="card-body">
                        <b>Cours de soutien</b>
                           <p class="card-text">
                           <b>Prix d'une séance :</b> 150 DH
                           </p>
                       </div>
                 </div>
              </div>

              <div class="col-lg-3 m-5">
                 <div class="card">
                    <img src="set-speech-bubbles-20849240.jpg" alt="" class="img-fluid rounded-top">
                       <div class="card-body">
                          <b>Les langues</b>
                            <p class="card-text">
                            <b>Prix d'une séance :</b> 150 DH
                           </p>
                       </div>
                  </div>
               </div>

              <div  id="d" class="col-lg-3 m-5 ">
                <div class="card">
                  <img src="info.jpg" alt="" class="img-fluid rounded-top">
                    <div class="card-body">
                       <b>Formation informatique</b>
                        <p class="card-text">
                           <b>Prix d'une séance :</b> 200 DH
                         </p>
                     </div>
                </div>
              </div>
          </div>
  </section>
  <section id="vous" class="sec4 py-5 m-0">
      <div class="container-fluid ">
        <div class="row">
          <div class="col-12 text-center mt-5">
           <h1 class="font-weight-bold">Vous êtes</h1>
          </div>
        </div>
      </div>
      <section class="sec3">
        <div  class="paragraph">
          <h2><a href="login.php">Administration</a></h2>
            <p class="p1">Utilisateur en tant qu'admin</p>
         </div>

        <div class="paragraph">
          <h2><a href="page4.html">Enseignement</a></h2>
          <p class="p1">Utilisateur en tant qu'Enseignement</p>
        </div>

        <div class="paragraph">
          <h2><a href="login2.php">Étudiant</a></h2>
          <p class="p1">Utilisateur en tant qu'étudiant</p>
         </div>
      </section>
  </section>


 <section id="contact" class="sec5 py-5  ">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mb-4">
        <!-- Titre global de la section Contact -->
        <h2 class="font-weight-bold mt-5">Contact</h2>
      </div>
    </div>
    <div class=" row border border-dark rounded col-md-12 ">
      <div class="col-md-6 mt-5 ">
        <!-- Contenu avec les informations de contact -->
        <h4 class="container">Nous trouver</h4>
        <p><i class="fab fa-facebook-square"></i> Facebook : <a href="[Lien vers votre page Facebook]">Excellency&Hub</a></p>
        <p><i class="fab fa-instagram"></i> Instagram : <a href="[Lien vers votre compte Instagram]">Excellency&Hub</a></p>
        <p><i class="fas fa-envelope"></i> Email : excellencyHub@gmail.com</p>
        <p><i class="fas fa-phone"></i> Téléphone : 0681546930</p>
      </div>
      <div class="col-md-6 mt-5">
        <!-- Formulaire de contact -->
        <h4 class="container">Envoyez-nous un message</h4>
        <form action="#" method="post">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Nom" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="5" placeholder="Message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary container">Envoyer</button>
        </form>
      </div>
    </div>
  </div>
</section>
<style>
  .sec2 {
  background-image: url('a.jpg');
  background-size: cover;
  background-position: center;
  
 }
  .sec4 {
  background-image: url('a.jpg');
  background-size: cover;
  background-position: center;
 }
  .sec5 {
  background-image: url('a.jpg');
  background-size: cover;
  background-position: center;
   }
  

  

</style>
<footer class="footer text-center py-3 bg-primary text-white">
  <p>© 2023 Excellenct&Hub</p>
 </footer>
 <style>
  .footer {
  
  bottom: 0;
  width: 100%;
 }

 </style>
<?php include('footer.php') ?>