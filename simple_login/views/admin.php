<?php
require_once realpath(__DIR__."/../controllers/admin.php");

$sorry_head = $title;
$sorry_content = $content["coming_soon"];

include HEADER;
include SORRY;
include FOOTER; 
