<?php 
require_once realpath(__DIR__."/../controllers/init.php");

if (array_key_exists("nick", $_SESSION)) {
  // remove all the variables associated to the session
  session_unset();
  // destroy the session
  session_destroy();
}

// redirect to homepage
header("Location: ".INDEX_PHP);
exit();