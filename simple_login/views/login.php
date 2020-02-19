<?php 
require_once realpath(__DIR__."/../controllers/init.php");

if (array_key_exists("nick", $_SESSION)) {
  header("Location: ".INDEX_PHP);
}

if (!isset($is_signup) || !$is_signup) {
  $is_signup = false;
  $action_php = CONNECT_PHP;
  $action_str = $content["login"];
  $btn_class = "btn-success";
} else {
  $action_php = REGISTER_PHP;
  $action_str = $content["signup"];
  $btn_class = "btn-info";
}

// Set the title. 
$title = $action_str;
$include_login = true;

include HEADER; 
include FORMS;
include FOOTER;