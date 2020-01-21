<?php 
require_once realpath(__DIR__."/init.php");
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

*/

// db variables:
$conn = null;
$dsn = "mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME;

// Connect to db:
try {  
  $conn = new PDO($dsn, DB_USER, DB_PASS);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed.<br>".$e->getMessage());
}

function does_nick_exist(string $nick, PDO $connection) : bool {
  $select = $connection->prepare(
    "SELECT `nick` FROM ".DB_NAME.".`accounts` WHERE `accounts`.`nick` = ?;");
  if ($select->execute([$nick])) {
    while ($row = $select->fetch()) {
      if ($row === $nick) {
        return true;
      }
    }
  }
  return false;
}

function create_user(string $nick, string $hash, PDO $connection) : bool {
  $insert = $connection->prepare(
    "INSERT INTO ".DB_NAME.".`accounts` (`nick`, `pass`) VALUES (:nick, :hash);"
  );
  
  $insert->bindValue(":nick", $nick);
  $insert->bindValue(":hash", $hash);
  
  $insert->execute();
  
  // check if it worked:
  return true;
}

function user_login(string $nick, string $pass, PDO $connection) : string {
  $preped = $connection->prepare("SELECT `pass` FROM ".DB_NAME.".`accounts` 
                                  WHERE `accounts`.`nick` = :nick;");

  $preped->bindValue(":nick", $nick);
  // Execute prepared statment. 
  if ($preped->execute()) {
    $hash = null;
    
    while ($row = $preped->fetch()) {
      $hash = $row;
    }
    
    if (isset($hash) && password_verify($pass, $hash[0])) { 
      if (!array_key_exists("nick", $_SESSION)) {
        $_SESSION["nick"] = hash("sha256", $nick);
      }
      return SUCCESS;
    }
    
    return FAILURE;
  } 
}
