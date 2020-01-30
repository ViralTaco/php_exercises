<?php 
ob_start();
$is_signup = true; 
// the signup jQuery ajax is in the following include. 
include "login.php";
ob_end_flush();