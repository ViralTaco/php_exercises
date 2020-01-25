<?php 
require_once realpath(__DIR__."/../../controllers/init.php");

/**
 * 
 * This file contains the view (template) for the header
 * 
 * @author: Capobianco Anthony 
 * 
 * @license: SPDX License Identifier: MIT
 * Copyright © 2020 Capobianco Anthony
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of 
 * this software and associated documentation files (the "Software"), to deal in the 
 * Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice (including the next paragraph) 
 * shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

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
<!-- popper js -->
  <script type="text/javascript" 
          src="<?= INCLUDE_URL ?>js/popper.min.js"></script>
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
      document.cookie = `lang=${lang};path=/`;
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
      <nav class="navbar fixed-top w-100 navbar-expand-lg navbar-dark bg-dark" 
           id="main-menu">
<!-- branding -->          
      <a class="navbar-brand"
         href="<?= INDEX_PHP ?>"><?= $content["website_name"] ?></a>
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
<!-- admin -->   
<?php if ($has_session) { ?>
          <li class="nav-item">
            <a class="nav-link"
               href="<?= ADMIN_PHP ?>"><?= $content["admin"] ?></a>
          </li>
<?php } ?>          
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