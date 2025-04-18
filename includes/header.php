<!DOCTYPE html>
<html>

<head lang="it">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
  if (isset($title))
    echo '<title>' . $title . ' | Aurumè Official Store</title>';
  ?>

  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="resources/css/config.css">
  <link rel="stylesheet" href="resources/css/header.css">
  <link rel="stylesheet" href="resources/css/footer.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-straight/css/uicons-regular-straight.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css">
  <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">

  <?php
    if (isset($cssFile))
      echo '<link rel="stylesheet" href="' . $cssFile . '">';
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    // Se l'utente ha terminato la sessione senza eseguire il logout, 
    // ripristino la sessione utilizzando i cookie
    if (!isset($_SESSION["user_id"]) && isset($_COOKIE["user_id"]) && isset($_COOKIE["user_name"]) && isset($_COOKIE["user_email"])) {
      $_SESSION["user_id"] = $_COOKIE["user_id"];
      $_SESSION["user_name"] = $_COOKIE["user_name"];
      $_SESSION["user_email"] = $_COOKIE["user_email"];
    }
  ?>

  <script src="https://js.stripe.com/v3/" defer></script>
  <script src="resources/js/header.js" defer></script>
</head>

<body>

  <header id="navbar">
    
    <!-- Bottone per aprire il menu laterale -->
    <button id="openMenu" onclick="openMenu()"><i class="fi fi-rs-bars-sort"> Menu</i></button>

    <!-- Titolo centrale del sito -->
    <div class="header-title"><a href="index.php">A U R U M È</a></div>
    
    <!-- Icone: ricerca, utente e carrello -->
    <div class="right-icons">
      <?php if (isset($_SESSION["user_name"])): ?>
        <button class="user-icon" onclick="toggleMenu()">
          <!-- Icona utente loggato -->
          <i class="fi fi-rs-user"><?php echo $_SESSION["user_name"]; ?></i>
        </button>

        <!-- Menu a tendina per utente loggato con area utente e logout -->
        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info"><?php echo $_SESSION["user_name"]; ?></div>
            <hr>
            <a href="area_utente.php" class="sub-menu-link">
              <img src="resources/img/profile.png" alt="Area Utente">
              <p>Area Utente</p>
              <span> &#62; </span> <!-- Simbolo "maggiore" in Unicode -->
            </a>
            <a href="action/logout.php" class="sub-menu-link">
              <img src="resources/img/logout.png" alt="Logout">
              <p>Logout</p>
              <span> &#62; </span>  <!-- Simbolo "maggiore" in Unicode -->
            </a>
          </div>
        </div>

      <?php else: ?>
        <!-- Icona utente non loggato -->
        <a href="autenticazione.php"><i class="fi fi-rs-user"></i></a>
      <?php endif; ?>
      <!-- Icona carrello -->
      <a href="carrello.php"><i class="fi fi-rs-shopping-bag"></i></a>
    </div>
  </header>

  <!-- Menu laterale -->
  <div id="sidenav">
    <div class="sidenav-content">
      <!-- Bottone chiudi menu -->
      <div id="closeMenu">
        <button class="close-button" onclick="closeMenu()"><span class="close-X">&#215;<span class="close-text">Chiudi</span></span></button>
      </div>
      <!-- Collegamenti principali menu -->
      <a  href="catalogo.php" class="catalogo">Catalogo</a>
      <ul class="filtri-catalogo">
        <li><a href="catalogo.php" class="filtra-catalogo" onclick="salvaCategoria('anelli')">Anelli</a></li>
        <li><a href="catalogo.php" class="filtra-catalogo" onclick="salvaCategoria('collane')">Collane</a></li>
        <li><a href="catalogo.php" class="filtra-catalogo" onclick="salvaCategoria('bracciali')">Bracciali</a></li>
        <li><a href="catalogo.php" class="filtra-catalogo" onclick="salvaCategoria('orecchini')">Orecchini</a></li>
        <li><a href="catalogo.php" class="filtra-catalogo" onclick="salvaCategoria('orologi')">Orologi</a></li>
      </ul>
      <!-- Collegamenti secondari menu -->
      <div class="sidenav-bottom">
        <ul>
          <li><a href="faq.php" class="sidenav-bottom-link">FAQ</a></li>
          <li><a href="contatti.php" class="sidenav-bottom-link">Contatti</a></li>
          <li><a href="la_nostra_storia.php" class="sidenav-bottom-link">La nostra storia</a></li>
          <li><a href="termini_condizioni.php" class="sidenav-bottom-link">Termini e condizioni</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Maschera per il blur della pagina -->
  <div id="blur" onclick="closeMenu()"></div>
