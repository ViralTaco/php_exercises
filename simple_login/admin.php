<?php
session_start();
require_once realpath(__DIR__."/internals/constants.php");


if (!isset($_SESSION["nick"])) {
  header("Location: ".LOGIN_PHP);
}
?>