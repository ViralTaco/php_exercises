<?php 
require_once realpath(__DIR__."/../controllers/init.php");

$title = $content["404_title"];
$sorry_head = "404";
$sorry_content = $content["404_message"];
// set error 404
header(HEADER_404_STR); 

include HEADER; 
include SORRY;
include FOOTER; 