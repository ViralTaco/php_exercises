<?php
session_start();
require_once realpath(__DIR__."/internals/constants.php");

session_destroy();
header("Location: ".INDEX_PHP);
exit();