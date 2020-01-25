<?php 
session_start();
require_once realpath(__DIR__."/../models/constants.php");
require_once realpath(__DIR__."/../models/localization.php");
require_once realpath(__DIR__."/../models/sql.php");
require_once realpath(__DIR__."/../models/user.php");

/**
 * This file contains the controller responsible for setting up
 * the global variables. It start the session, includes the necessary 
 * models (the: "headers"). It defines a `get` function and checks 
 * and/or sets a cookie for localization. 
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

/**
 * This function gets a post value and sanitizes it
 *
 * @param $key the key for $_POST[$key]
 *
 * @return a string with escaped text
 */
function get_post_value(string $key) : string {
  return stripslashes(htmlspecialchars($_POST[$key]));
}

// check if the 'lang' cookie is set.
if (!array_key_exists("lang", $_COOKIE)
// if it exists check if it's a valid locale
|| !array_key_exists($_COOKIE["lang"], $locale)) {
// if not set the lang to 'fr'
  setcookie("lang", DEFAULT_LANG);
  $lang = DEFAULT_LANG;
} else {
  $lang = $_COOKIE["lang"];
}

// set the content array to the right language
$content = $locale[$lang];

if (defined("DEBUG") && DEBUG === true) {
  error_reporting(E_ALL | E_STRICT); 
  ini_set('display_errors', 1);
  $content["website_name"] = "DEBUG";
}