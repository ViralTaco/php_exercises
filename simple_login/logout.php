<?php
session_start();
require_once realpath(__DIR__."/internals/constants.php");

if (isset($_SESSION["nick"])) {
  session_unset();
  session_destroy();
}
header("Location: ".INDEX_PHP);
exit();