<?php
if (!defined("VT_CONSTANTS_PHP")) {
  define("VT_CONSTANTS_PHP", true);
  define("DEFAULT_LANG", "fr");

  define("HEADER_404_STR", "HTTP/1.0 404 Not Found");
  
  define("HEADER", realpath(__DIR__."/../templates/header.php"));
  define("FOOTER", realpath(__DIR__."/../templates/footer.php"));
  
  define("ROOT_URL", "http://".getenv("HTTP_HOST")."/");
  
  define("INDEX_PHP", ROOT_URL);
  define("LOGIN_PHP", ROOT_URL."login.php");
  define("LOGOUT_PHP", ROOT_URL."logout.php");
  define("ER404_PHP", ROOT_URL."404.php");
  define("CONNECT_PHP", ROOT_URL."connect.php");
  define("REGISTER_PHP", ROOT_URL."register.php");
  define("SIGNUP_PHP", ROOT_URL."signup.php");
  define("ADMIN_PHP", ROOT_URL."admin.php");
  define("LANG_PHP", ROOT_URL."lang.php");
  
  define("FIRST_YEAR", "2020");
  define("CURRENT_YEAR", date("Y"));
  
  if (FIRST_YEAR == CURRENT_YEAR) {
    define("COPYRIGHT_DATE", FIRST_YEAR);
  } else {
    define("COPYRIGHT_YEAR", FIRST_YEAR." - ".CURRENT_YEAR);
  }

  define("SUCCESS", "1");
  define("FAILURE", "FAILURE");
  
  // MySQL constants:
  define("DB_HOST", "127.0.0.1");
  define("DB_PORT", "8889");
  define("DB_USER", "notroot");
  define("DB_PASS", "FHfGnqhANotqglqr");
  define("DB_NAME", "loginform");
  
}
