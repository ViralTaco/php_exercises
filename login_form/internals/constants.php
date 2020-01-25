<?php
/**
 * This file contains the constant for this project
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

if (!defined("VT_CONSTANTS_PHP")) {
  define("VT_CONSTANTS_PHP", true);

  define("WEBSITE_NAME", "Login Form");
  define("HEADER_404_STR", "HTTP/1.0 404 Not Found");
  
  
  define("HEADER", realpath(__DIR__."/../templates/header.php"));
  define("FOOTER", realpath(__DIR__."/../templates/footer.php"));

  define("USER_PHP", realpath(__DIR__."/User.php"));
  define("USEREXCEPTION_PHP", realpath(__DIR__."/UserException.php"));
  define("SQL_PHP", realpath(__DIR__."/sql.php"));
  
  define("ROOT_URL", "http://".$_SERVER["HTTP_HOST"]."/");
  
  define("INDEX_PHP", ROOT_URL);
  define("LOGIN_PHP", ROOT_URL."login.php");
  define("ER404_PHP", ROOT_URL."404.php");
  define("CONNECT_PHP", ROOT_URL."connect.php");
  
  define("FIRST_YEAR", "2020");
  define("CURRENT_YEAR", date("Y"));
  
  if (FIRST_YEAR == CURRENT_YEAR) {
    define("COPYRIGHT_DATE", FIRST_YEAR);
  } else {
    define("COPYRIGHT_YEAR", FIRST_YEAR." - ".CURRENT_YEAR);
  }
  
  define("SUCCESS", "1");
  define("FAILURE", "FAILURE");
}
