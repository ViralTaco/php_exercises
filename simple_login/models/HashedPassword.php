<?php
require_once realpath(__DIR__."/../controllers/init.php");
/**
 * 
 * This file contains the model for the user password hashes.
 * The idea is to have a specific type so a hashed password 
 * can't ever be confused with a plain string. 
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

class HashedPassword {
  protected $hash;
  
  public function __construct(string $raw_pass, string $raw_conf) {
    if (empty($raw_pass) || $raw_conf !== $raw_conf) {
      throw new InvalidArgumentException(
        "HashedPassword() was passed an empty string."
      );
    }
    $this->hash = (string) password_hash($raw_pass, PASSWORD_DEFAULT);
  }
  
  public function __toString() : string {
    return $this->hash;
  }
}