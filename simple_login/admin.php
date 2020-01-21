<?php 
require_once realpath(__DIR__."/internals/init.php");

if (!array_key_exists("nick", $_SESSION)) {
  header("Location: ".LOGIN_PHP);
} ?>