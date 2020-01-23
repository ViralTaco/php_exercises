<?php session_start();
require_once realpath(__DIR__."/../models/constants.php");
require_once realpath(__DIR__."/../models/localization.php");
require_once realpath(__DIR__."/../models/sql.php");
require_once realpath(__DIR__."/../models/user.php");

/**
 * This function gets a post value and sanitizes it
 *
 * @param $key the key for $_POST[$key]
 *
 * @return a string with escaped text
 */
function get_post_value(string $key) : string {
  return stripslashes(htmlspecialchars($_POST[$key]));
}

// check if the 'lang' cookie is set.
if (!array_key_exists("lang", $_COOKIE)
// if it exists check if it's a valid locale
|| !array_key_exists($_COOKIE["lang"], $locale)) {
// if not set the lang to 'fr'
  setcookie("lang", DEFAULT_LANG);
  $lang = DEFAULT_LANG;
} else {
  $lang = $_COOKIE["lang"];
}

// set the content array to the right language
$content = $locale[$lang];