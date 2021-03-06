<?php 
require_once "constants.php";
require_once "sql.php";
require_once "HashedPassword.php";

/**
 * This file contains the model for the user connection
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

function does_nick_exist(string $nick) : bool {
  $connection = get_db();
  $select = $connection->prepare(
    "SELECT `nick` 
     FROM ".DB_NAME.".`accounts` 
     WHERE `accounts`.`nick` = ?;"
  );
  
  if ($select->execute([$nick])) { 
    // if fetch doesn't return NULL or false the nick exists
    return $select->fetch(PDO::FETCH_ASSOC) != false;
  }
  return false;
}

function create_user(string $nick, 
                     HashedPassword $hash, 
                     string $mail) : bool {
  if (does_nick_exist($nick)) { return false; }
  $connection = get_db();
  $insert = $connection->prepare(
    "INSERT INTO ".DB_NAME.".`accounts` (`nick`, `pass`, `mail`) 
     VALUES (:nick, :hash, :mail);"
  );
  
  $insert->bindValue(":nick", $nick);
  $insert->bindValue(":hash", $hash);
  $insert->bindValue(":mail", $mail);
  
  return $insert->execute() !== false;
}

function user_login(string $nick, string $raw_pass) : bool {
  $connection = get_db();
  $preped = $connection->prepare(
    "SELECT `pass` 
     FROM ".DB_NAME.".`accounts` 
     WHERE `accounts`.`nick` = :nick;"
  );

  $preped->bindValue(":nick", $nick);
  // Execute prepared statment. 
  if ($preped->execute()) {
    $hash = null;
    
    while ($row = $preped->fetch()) {
      $hash = $row;
    }
    
    if (isset($hash) && password_verify($raw_pass, $hash["pass"])) { 
      if (!array_key_exists("nick", $_SESSION)) {
        $_SESSION["nick"] = $nick;
      }
      return true;
    }
    
    return false;
  } 
}

function get_user(string $nick) {
  $connection = get_db();
  $preped = $connection->prepare(
    "SELECT `nick`, `mail`
     FROM ".DB_NAME.".`accounts` 
     WHERE `accounts`.`nick` = :nick;"
  );
  $preped->bindValue(":nick", $nick);
  
  if ($preped->execute()) {
    $tmp = $preped->fetch(PDO::FETCH_ASSOC);
    if (array_key_exists("nick", $tmp) && array_key_exists("mail", $tmp)) {
      return [ 
        "username" => $tmp["nick"],
        "mail" => $tmp["mail"],
      ];
    }
  }
  return [];
}

function is_valid_mail(string $email) : bool {
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_admin() : bool {
  if (!array_key_exists("nick", $_SESSION)
  || !does_nick_exist($_SESSION["nick"])) {
    return false;
  }
  
  $connection = get_db();
  $select = $connection->prepare(
    "SELECT `isAdmin` 
     FROM ".DB_NAME.".`accounts` 
     WHERE `accounts`.`nick` = :nick;"
  );
  
  $select->bindValue(":nick", $_SESSION["nick"]);  
  
  if ($select->execute()) {
    $val = null;
    
    while ($row = $select->fetch()) {
      if (array_key_exists("isAdmin", $row)) {
        return $row["isAdmin"] == 1;
      }
    }
  } 
  return false;
}

// TODO: edit_nick(); 
function edit_nick(string $current, string $new): bool {
  $connection = get_db();
  $edit_query = $connection->prepare("UPDATE `".DB_NAME."`.`accounts`
                                      SET `nick` = :new
                                      WHERE `nick` = :current");
  $edit_query->bindValue(":new", $new);                                        
  $edit_query->bindValue(":current", $current);
  
  return $edit_query->execute() !== false;
}
// TODO: edit_mail(); 
// TODO: edit_pass(); 
// TODO: delete_user(); 