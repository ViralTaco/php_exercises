<?php

abstract class ConnectionException extends Exception {
  static protected $reason;
  
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

class NotAdminException extends ConnectionException {
  public function __construct(string $msg = "") {
    parent::__construct($msg);
    $this::$reason = "User isn't an admin.";
  }
}