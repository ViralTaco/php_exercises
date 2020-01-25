<?php
/**
 * This file contains the model for UserException
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

abstract class UserException extends Exception {
  static protected string $reason;
  
  public function __construct(string $message) {
    parent::__construct($message);
  }
  
  public function __toString() : string {
    return "Error on line: ".$this->getLine()
          ."\nIn file: ".$this->getFile()
          ."\nMessage: ".$this->getMessage()
          ."\nReason: ".$this::$reason;
  }
}

class InvalidNicknameException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "Invalid nickname given.";
  }
}

class InvalidUserIdException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "Invalid user ID.";
  }
}

class InvalidPasswordException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "Invalid user password.";
  }
}

class UserAlreadyConnectedException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "User already connected.";
  }
}

class UserNotConnectedException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "User not connected.";
  }
}

class CannotDisconnectException extends UserException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "Could not disconnect.";
  }
}
