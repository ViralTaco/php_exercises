<?php 
require_once "init.php";
require_once realpath(__DIR__."/../models/Exceptions/ConnectionExceptions.php");

/**
 * This file contains controller for the admin page
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

function clean_array(Array $arr) : Array {
  foreach ($arr as $key => $row) { 
    if (empty($row)
    || !array_key_exists("id", $row) 
    || !array_key_exists("username", $row) 
    || !array_key_exists("mail", $row) 
    || !array_key_exists("isAdmin", $row)) { 
      unset($arr[$key]);
      continue; 
    }
  }
  return $arr;
}

function get_accounts_table(int $page = 0, int $limit = 10) : Array {
  if (!is_admin()) { throw new NotAdminException(); }
  $connection = get_db();
  $select = $connection->prepare("SELECT `id`, `nick`, `mail`, `isAdmin`
                                  FROM ".DB_NAME.".`accounts` 
                                  LIMIT :from, :limit;");
  $from = $page * $limit;
  $select->bindValue(":from", $from);
  $select->bindValue(":limit", $from + $limit);
  
  $arr = [
    [ "id", "username", "mail", "isAdmin" ]
  ];
  if ($select->execute()) {
    $tmp = $select->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tmp as $val) {
      if (array_key_exists("id", $val) 
      && array_key_exists("nick", $val) 
      && array_key_exists("mail", $val) 
      && array_key_exists("isAdmin", $val)) {
        $arr[] = [ 
          "id" => $val["id"],
          "username" => $val["nick"],
          "mail" => $val["mail"],
          "isAdmin" => $val["isAdmin"] == 1,
        ];
      } // if array has all keys
    } // foreach array
  } // if PDO::execute()
  return clean_array($arr);
}

function get_accounts_columns() : Array {
  return ["id", "username", "mail"];
}

function accounts_row_count() : int {
  if (!is_admin()) { throw new NotAdminException(); }
  $connection = get_db();
  $select = $connection->prepare("SELECT `id`FROM ".DB_NAME.".`accounts`;");
  $select->execute();
  return $select->rowCount();
}

function page_count(int $limit = 10) : int {
  $items = accounts_row_count();
  return ($items >= $limit)
       ? 0
       : intval($items / $limit) + 1
       ;
}
