<?php 
require_once realpath(__DIR__."/internals/init.php");

$new_lang = get_post_value("lang");
if (!array_key_exists($new_lang, $locale)) { 
  die(); 
}

setcookie("lang", $new_lang);
$lang = $new_lang;
exit(SUCCESS);
