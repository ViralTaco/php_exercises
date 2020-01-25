<?php
if (!defined("VT_CONSTANTS_PHP")) {
  define("VT_CONSTANTS_PHP", true);
  
  // debug: 
  // TODO: DON'T DEFINE THIS IN PROD
  define("DEBUG", true);
  
  // default language:
  define("DEFAULT_LANG", "fr");

  // HTTP headers:
  define("HEADER_404_STR", "HTTP/1.0 404 Not Found");
  
  // path to templates:
  define("HEADER", realpath(__DIR__."/../views/templates/header.php"));
  define("FOOTER", realpath(__DIR__."/../views/templates/footer.php"));
  define("FORMS", realpath(__DIR__."/../views/templates/forms.php"));
  define("CARDS", realpath(__DIR__."/../views/templates/cards.php"));
  define("SORRY", realpath(__DIR__."/../views/templates/sorry.php"));
  
  // website root:
  define("ROOT_URL", "http://".getenv("HTTP_HOST")."/");
  
  // view URLs:
  define("INDEX_PHP", ROOT_URL);
  define("LOGIN_PHP", ROOT_URL."views/login.php");
  define("LOGOUT_PHP", ROOT_URL."views/logout.php");
  define("ER404_PHP", ROOT_URL."views/404.php");
  define("SIGNUP_PHP", ROOT_URL."views/signup.php");
  define("ADMIN_PHP", ROOT_URL."views/admin.php");
  
  // controller URLs:
  define("CONNECT_PHP", ROOT_URL."controllers/connect.php");
  define("REGISTER_PHP", ROOT_URL."controllers/register.php");
  
  // dates:
  // begin of copyright year 
  define("FIRST_YEAR", "2020");
  define("CURRENT_YEAR", date("Y"));
  
  // copyright:
  if (FIRST_YEAR == CURRENT_YEAR) {
    define("COPYRIGHT_DATE", FIRST_YEAR);
  } else {
    define("COPYRIGHT_YEAR", FIRST_YEAR." - ".CURRENT_YEAR);
  }

  // ajax responses:
  define("SUCCESS", "1");
  define("INVALID_EMAIL", "2");
  define("FAILURE", "FAILURE");
  
  // MySQL constants:
  define("DB_HOST", "127.0.0.1");
  define("DB_PORT", "8889");
  define("DB_USER", "notroot");
  define("DB_PASS", "FHfGnqhANotqglqr");
  define("DB_NAME", "loginform");
  
}
