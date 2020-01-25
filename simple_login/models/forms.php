<?php
require_once realpath(__DIR__."/../controllers/init.php");
/**
 * This file contains the model for handling connection failures
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
 * This function sets the global `error_message` variable to $msg
 * and returns the "Location: ".$origin
 *
 * @param $origin a URL 
 * @param $msg an error message
 *
 * @return string the location for header()
 */
function form_error(string $origin, ?string $msg) : string {
  $GLOBALS["error_message"] = $msg;
  return "Location: ".$origin;
}

/**
 * This function sets the global `error_message` variable to null
 * and returns the "Location: ".$origin
 *
 * @param $origin a URL 
 *
 * @return string the location for header()
 */
function form_success(string $origin) : string {
  return form_error($origin, null);
}

/// form_error specialization where $origin = SIGNUP_PHP
function signup_error(string $msg) : string {
  return form_error(SIGNUP_PHP, $msg);
}

/// form_error specialization where $origin = LOGIN_PHP
function login_error(string $msg) : string {
  return form_error(LOGIN_PHP, $msg);
}


/// form_success specialization where $origin = LOGIN_PHP
function signup_success() : string {
  return form_success(LOGIN_PHP);
}

/// form_success specialization where $origin = INDEX_PHP
function login_success() : string {
  return form_success(INDEX_PHP);
}

