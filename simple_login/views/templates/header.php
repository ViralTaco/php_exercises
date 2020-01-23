<?php 
require_once realpath(__DIR__."/../../controllers/init.php");

// Make sure title is set otherwise redirect to 404 page.
if (!isset($title)) { 
  header("Location: ".ER404_PHP); 
} 

$has_session = array_key_exists("nick", $_SESSION);
define("INCLUDE_URL", ROOT_URL."views/includes/");
?>

<!doctype html> <html lang="<?= $lang ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" 
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title; ?></title>
<!-- bootstrap css -->
  <link rel="stylesheet" 
        type="text/css" 
        href="<?= INCLUDE_URL ?>css/bootstrap.min.css">
<!-- custom css -->
  <link rel="stylesheet" 
        type="text/css" 
        href="<?= INCLUDE_URL ?>css/styles.css">
<!-- jQuery js -->
  <script type="text/javascript" 
          src="<?= INCLUDE_URL ?>js/jquery.min.js"></script>
<!-- jQuery-ui js -->
  <script type="text/javascript" 
          src="<?= INCLUDE_URL ?>js/jquery-ui.min.js"></script>
<!-- bootstrap js -->
  <script type="text/javascript" 
          src="<?= INCLUDE_URL ?>js/bootstrap.min.js"></script>
<!-- language js -->
  <script type="text/javascript">
    /**
     * this function sets a cookie for the language 
     * and reloads the page 
     *
     * @param `lang` a string corresponding to a key 
     *   in the language array (cf: models/localization.php)
     */
    function setLang(lang) {
      document.cookie = `lang=${lang}`;
      window.location.reload();
    }
    
    $(() => {
<?php foreach($locale as $key => $_) { ?>
      $('#<?= $key ?>').click((event) => {
        setLang('<?= $key ?>');
      });
<?php } ?>
    });
  </script>

<?php if (isset($login_php)) {
  echo $login_php;
} 
?>

</head>
<body>
  <header>
      <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" 
           id="main-menu">
      <a class="navbar-brand"><?= $content["website_name"] ?></a>
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
<!-- home -->              
            <a class="nav-link"
               href="<?= INDEX_PHP ?>"><?= $content["home"] ?></a>
          </li>
          <li class="nav-item">
<!-- menu -->          
            <a class="nav-link"
               href="#"><?= $content["menu"] ?></a>
          </li>
        </ul>
        <div class="navbar-right"
             id="login">    
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown mr-2">
<!-- language selection -->            
              <a class="nav-link dropdown-toggle" 
                 href="#" 
                 id="lang-select" 
                 role="button" 
                 data-toggle="dropdown" 
                 aria-haspopup="true" 
                 aria-expanded="false"><?= $content["language"] ?></a>
              <div class="dropdown-menu" 
                   aria-labelledby="lang-select">
<?php foreach ($locale as $key => $arr) { ?>
                <a class="dropdown-item" 
                   href="#"
                   id="<?= $key ?>"><?= $arr["language"] ?></a>
<?php } ?>
              </div>
            </li>
<!-- sign up -->
<?php if (!$has_session) { ?>
            <li class="nav-item mr-2">
              <a class="btn btn-outline-info" 
                 href="<?= SIGNUP_PHP ?>"><?= $content["signup"] ?></a>
            </li>
<?php } ?>            
            <li class="nav-item mr-2">
<!-- log in/out -->            
<?php if (!$has_session) { ?>
              <a class="btn btn-outline-success" 
                 href="<?= LOGIN_PHP ?>"><?= $content["login"] ?></a>
<?php } else { ?>
              <a class="btn btn-outline-danger" 
                 href="<?= LOGOUT_PHP ?>"><?= $content["logout"] ?></a>
<?php } ?>
            </li>            
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main id="main"
        role="main">