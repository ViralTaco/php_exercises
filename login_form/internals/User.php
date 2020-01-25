<?php 
/**
 * This file contains the model for the user
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
require_once realpath(__DIR__."/constants.php");
require_once SQL_PHP;
require_once USEREXCEPTION_PHP;

class User {
  public bool $is_connected = false;
  public string $connection_id = "";
  public string $nick;
  
  private string $user_id;
  private string $password_hash; 
  private bool $is_valid_password;

  private $preped;

// constructor:
  public function __construct(string $user, string $plaintext_pass) {
    $this->$preped = $conn->prepare("SELECT `id` FROM `loginform`.`accounts` 
                                     WHERE `accounts`.`nick` = :nick 
                                       AND `accounts`.`pass` = :pass;");
    $this->$preped->bindParam(":nick", $this->$nick);
    $this->$preped->bindParam(":pass", $this->$pass);
    $this->$nick = $user;
    $this->$password_hash = hash("sha256", $plaintext_pass);
  }
  
// getters: 
  public function get_user_id() : string {
    if (!isset($this->$user_id)) {
      throw new InvalidUserIdException("User ID not set.");
    }
    return $this->$user_id;
  }

// public methods:
  public function check_pass() : int {
    if (User::$preped->execute()) {
      $id = 0;
      while ($row = $preped->fetch()) {
        $id = $row;
      }
      return $id;
    } 
    return -1;
  }
  
  public function connect() : void {
    if ($this->$is_connected) {
      throw new UserAlreadyConnectedException("This user is already connected.");
    }
    // Not already connected, continue. 
    $pass_check_returned = $this->check_pass();
    if ($pass_check_returned == -1) {
      throw new InvalidPasswordException("Wrong password.");
    } else {
      $this->$user_id = $pass_check_returned;
      $this->$is_valid_password = true;
    }
    
    $now = new DateTime();
    $this->$connection_id = hash('sha256', $nick.$now->format('Y-m-d'));
    
    $insert = $conn->prepare("INSERT INTO `loginform`.`sessions` (`id`, `account_id`)
                              VALUES (:connection_id, :id);");
    $insert->bindParam(":connection_id", $id);
    $insert->bindParam(":id", $user);
    $id = $this->$connection_id;
    $user = $this->$user_id;
    $insert->execute();
    
    $_SESSION[$this->$nick] = $this->$connection_id;
    $this->$is_connected = true;
  }
  
  public function disconnect() : void {
    if (!$this->$is_connected) {
      throw new UserNotConnectedException("This user is not connected.");
    }
    // User connected, keep going
    $remove = $conn->prepare("DELETE * FROM `loginform`.`sessions`
                              WHERE `sessions`.`id` = :connection_id
                                AND `sessions`.`account_id` = :user_id;");
                                
    $remove->bindParam(":connection_id", $id);
    $remove->bindParam(":user_id", $user);
    $id = $this->$connection_id;
    $user = $this->$user_id;
    
    if (!$remove->execute()) {
      throw new CannotDisconnectException("Could not close session: "
                                         .$this->$connection_id);
    }
    
    msession_destroy($this->$connection_id);
    $this->$connection_id = "";
    $this->$is_connected = false;
    $this->$is_valid_password = false;
  }
}
