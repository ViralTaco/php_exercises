<?php
require_once "sql.php";
require_once realpath(__DIR__."/Exceptions/ConnectionExceptions.php");

function get_accounts_table(int $from = 0, int $limit = -1) : Array {
  if (!is_admin()) { throw new NotAdminException(); }
  $connection = get_db();
  $select = $connection->prepare("SELECT (`id`, `nick`, `mail`, `isAdmin`) 
                                  FROM ".DB_NAME.".`accounts` 
                                  WHERE `accounts`.`id` >= :from
                                  LIMIT :limit;");
                                  
  $select->bindValue(":from", $from);
  $select->bindParam(":limit", ($limit <= 0) ? 10 : $limit);
  
  $arr = [
    "values" => [], 
    "id" => $from
  ];
  
  if ($select->execute()) {
    for (; $row = $select->fetch(); ++$from) {
      $arr["values"][$from] = $row;
    }
  }
  
  return $arr;
}