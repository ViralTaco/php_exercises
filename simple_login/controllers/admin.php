<?php 
require_once "init.php";

// If no session is registered redirect to login page
if (!array_key_exists("nick", $_SESSION)) {
  header("Location: ".LOGIN_PHP);
} 

class NotImplementedException extends BadMethodCallException {}
throw new NotImplementedException("admin.php controller not implemented.");
