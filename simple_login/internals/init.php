<?php session_start();
require_once realpath(__DIR__."/constants.php");
require_once realpath(__DIR__."/localization.php");
require_once realpath(__DIR__."/sql.php");

function get_post_value(string $key) : string {
  return stripslashes(htmlspecialchars($_POST[$key]));
}

$lang = null;
if (!array_key_exists("lang", $_COOKIE)) {
  setcookie("lang", DEFAULT_LANG);
  $lang = DEFAULT_LANG;
} else { 
  $lang = $_COOKIE["lang"];
}

$content = $locale[$lang];