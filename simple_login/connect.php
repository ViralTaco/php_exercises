<?php
/**
 * This file contains the model and controller for the MySQL database
 * It is based on the following online tutorial:
 * cf: https://alexwebdevelop.com/user-authentication/
 * 
 * @author: Capobianco Anthony 
 * 
 * @license: SPDX License Identifier: MIT
 * Copyright © 2020 Capobianco Anthony
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of 
 * this software and associated documentation files (the "Software"), to deal in the 
 * Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice (including the next paragraph) 
 * shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION 
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
/*
  accounts table:

    CREATE TABLE `accounts` (
      `id` INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `nick` VARCHAR(255) NOT NULL,
      `pass` VARCHAR(255) NOT NULL,
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;


  sessions table: 
    CREATE TABLE `sessions` (
      `id` VARCHAR(255) NOT NULL PRIMARY KEY,
      `account_id` INTEGER UNSIGNED NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
*/
session_start();
require_once realpath(__DIR__."/internals/constants.php");

function get_post_value(string $key) : string {
  return stripslashes(htmlspecialchars($_POST[$key]));
}

ob_start();
// db variables:
$conn = NULL;
$dsn = "mysql:host=".DB_HOST
      .";port=".DB_PORT
      .";dbname=".DB_NAME
      ;

// Connect to db:
try {  
  $conn = new PDO($dsn, DB_USER, DB_PASS);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Database connection failed.<br>".$e->getMessage();
}

$preped = $conn->prepare("SELECT `pass` FROM ".DB_NAME.".`accounts` 
                           WHERE `accounts`.`nick` = :nick;");

$preped->bindParam(":nick", $nick);
$nick = get_post_value("nick");
$pass = get_post_value("pass");

// Execute prepared statment. 
if ($preped->execute()) {
  $hash = null;
  
  while ($row = $preped->fetch()) {
    $hash = $row;
  }
  
  if (!isset($hash) || !password_verify($pass, $hash[0])) { 
    die(FAILURE); 
  }
  
  if (!isset($_SESSION["nick"])) {
    $_SESSION["nick"] = hash("sha256", $nick);
  }
  
  echo SUCCESS;
  exit();
} 

ob_end_flush();