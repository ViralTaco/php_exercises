<?php 
error_reporting(E_ALL | E_STRICT); 
ini_set('display_errors', 1);

define("ROOT_PATH", "/router/");

$request = str_replace(ROOT_PATH, "", $_SERVER["REQUEST_URI"]);
$segments = explode("/", $request);

if (count($segments) == 0) { 
  $segments[0] = "welcome"; 
}

define("REQ_TYPE", $segments[0] ?? "");
define("REQ_TYPE_ID", $segments[1] ?? "");
define("REQ_ALT", $segments[2] ?? "");

$file = "pages/".REQ_TYPE."php";
if (file_exists($file)) {
  include $file;
} else {
  include "pages/404.php";
  http_response_code(404);
}


?>