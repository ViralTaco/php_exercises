<?php
if (!defined("VT_CONSTANTS_PHP")) {
  define("VT_CONSTANTS_PHP", true);

  define("WEBSITE_NAME", "Login Form");
  define("HEADER_404_STR", "HTTP/1.0 404 Not Found");
  
  define("HEADER", realpath(__DIR__."/../templates/header.php"));
  define("FOOTER", realpath(__DIR__."/../templates/footer.php"));

  define("USER_PHP", realpath(__DIR__."/User.php"));
  define("USEREXCEPTION_PHP", realpath(__DIR__."/UserException.php"));
  define("SQL_PHP", realpath(__DIR__."/sql.php"));
  
  define("ROOT_URL", "http://".$_SERVER["HTTP_HOST"]."/");
  
  define("INDEX_PHP", ROOT_URL);
  define("LOGIN_PHP", ROOT_URL."login.php");
  define("LOGOUT_PHP", ROOT_URL."logout.php");
  define("ER404_PHP", ROOT_URL."404.php");
  define("CONNECT_PHP", ROOT_URL."connect.php");
  
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
