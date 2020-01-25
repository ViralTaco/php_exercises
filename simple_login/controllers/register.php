<?php 
require_once "init.php";
require_once realpath(__DIR__."/../models/forms.php");

/**
 * This file contains the controller to register a user in the MySQL DB
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
      `mail` VARCHAR(255) NOT NULL,
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

*/
ob_start();

$new_user = get_post_value("nick");
$new_pass = password_hash(get_post_value("pass"), PASSWORD_DEFAULT);
$new_mail = get_post_value("mail");

if (!does_nick_exist($new_user)) {
  if (!is_valid_mail($new_mail)) {
    header(signup_error($content["invalid_mail"]));
    exit();
  } else if (create_user($new_user, $new_pass, $new_mail)) { // try create_user
    header(signup_success());
    exit();
  }
} else { // nick already exists
  header(signup_error($content["nick_used"]));
  exit();
}

ob_end_flush();