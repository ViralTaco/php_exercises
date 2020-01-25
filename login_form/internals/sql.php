<?php
/**
 * This file contains the model for the MySQL database
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

// db variables:
$host = "127.0.0.1";
$port = "8889";
$user = "notroot";
$passwd = "FHfGnqhANotqglqr";

$schema = "loginform";
$conn = NULL;
$dsn = "mysql:host=".$host.";port=".$port.";dbname=".$schema;

// Connect to db:
try {  
  $conn = new PDO($dsn, $user, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed.");
}
