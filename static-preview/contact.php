


// mon HTML //

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vite&Gourmand - Bienvenue</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- font Inria -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>

</head>
<body class="home">

  <!-- HEADER -->
  <header class="topbar">
    <div class="container topbar-inner">
      <nav class="topnav" aria-label="Navigation principale">
        <a href="index.html" class="topnav-link"><img src="assets/icons/homepage.svg" class="icon-contact">accueil</a>
        <a href="menus.html" class="topnav-link"><img src="assets/icons/couverts.svg" class="icon-contact">menus</a>
        <a href="contact.html" class="topnav-link active" aria-current="page"><img src="assets/icons/envelope.svg" class="icon-contact">contact</a>
        <a href="connexion.html" class="topnav-link"><img src="assets/icons/account.svg" class="icon-contact">connexion</a>
      </nav>
    </div>
  </header>

   
   <!-- HERO AVEC LOGO À GAUCHE -->
  <section class="hero-banner">
    <div class="container hero-inner">
      <!-- LOGO CARTONNÉ INCLINÉ -->
      <div class="logo-card">
        <div class="logo-wrapper">
          <div class="logo-back"></div>
          <div class="logo-front">
            <img src="assets/logo.svg" alt="logo Vite&Gourmand">
          </div>
        </div>
      </div>
      <!-- TITRE HERO -->
      <div class="hero-title-block">
        <h1 class="hero-title">Le traiteur de tous vos événements</h1>
        <p class="hero-subtitle">depuis 25 ans</p>
      </div>
    </div>
  </section>


 <!-- BLOC DU CENTRE (main) -->
  <main class="container main py-5">
  <div class="page-inner">
    <section class="section-block section-tight">
      <h2 class="section-title-center">Contactez-nous</h2>
      <p class="text-center mb-4">
        Vous pouvez nous envoyer vos questions ou demandes via ce formulaire. Nous vous répondrons par mail.
      </p>

      <?php if($messageEnvoye): ?>
        <div class="alert alert-info text-center"><?= $messageEnvoye ?></div>
      <?php endif; ?>

      <form action="" method="POST" class="mx-auto" style="max-width:600px;">
        <div class="mb-3">
          <label for="titre" class="form-label">Titre</label>
          <input type="text" class="form-control" id="titre" name="titre" placeholder="Sujet de votre message" required>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="5" placeholder="Votre message..." required></textarea>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Votre email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
      </form>
    </section>
  </div>
</main>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container footer-inner">
      <div class="footer-left">
        <a href="mentions_legales.html" class="footer-link">mentions légales</a>
        <a href="cgv.html" class="footer-link">conditions générales de vente</a>
        <span class="footer-link">© <span class="underline-text">2026</span></span>
      </div>
      <div class="footer-center">
        <a href="contact.html" class="footer-link"><img src="assets/icons/envelope.svg" alt="" class="icon-contact">contact</a>
      </div>
      <div class="footer-right">
        <p class="footer-hours-title"><img src="assets/icons/time.svg" alt="" class="icon-contact">nos horaires :</p>
        <p class="footer-hours">
          du lundi au vendredi de 10h à 20h<br>
          samedi et dimanche de 12h à 16h
        </p>
      </div>
    </div>
  </footer>

</body>
</html>
