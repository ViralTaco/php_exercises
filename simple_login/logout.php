<?php require_once realpath(__DIR__."/internals/init.php");

if (isset($_SESSION["nick"])) {
  // remove all the variables associated to the session
  session_unset();
  // destroy the session
  session_destroy();
}

// redirect to homepage
header("Location: ".INDEX_PHP);
exit();