<?php
require_once realpath(__DIR__."/../internals/constants.php");

// Make sure title is set otherwise redirect to 404 page to avoid PHP error.
if (!isset($title)) { 
  header("Location: ".ER404_PHP); 
} 
?>
<!doctype html> <html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" 
        type="text/css" 
        href="<?php echo ROOT_URL; ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" 
        type="text/css" 
        href="<?php echo ROOT_URL; ?>css/styles.css">
  <script type="text/javascript" 
          src="<?php echo ROOT_URL; ?>jquery/jquery.min.js"></script>
  <script type="text/javascript" 
          src="<?php echo ROOT_URL; ?>bootstrap/js/bootstrap.min.js"></script>
  <title><?php echo $title; ?></title>
</head>
<body>
  <header class="">
      <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" 
           id="main-menu">
      <a class="navbar-brand"><?php echo WEBSITE_NAME; ?></a>
      <button class="navbar-toggler" 
              type="button" 
              data-toggle="collapse" 
              data-target="#hamburger" 
              aria-controls="navbarText" 
              aria-expanded="false" 
              aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse"
           id="hamburger">  
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" 
              id="home">
            <a class="nav-link"
               href="<?php echo INDEX_PHP; ?>">Accueil</a>
          </li>
          <li class="nav-item" 
              id="login">
            <a class="nav-link" 
               href="<?php echo LOGIN_PHP; ?>">Connection</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>