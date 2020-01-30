<?php
require_once realpath(__DIR__."/../controllers/init.php");

if (!array_key_exists("nick", $_SESSION)) {
  header("Location: ".ER404_PHP);
  die();
}

$title = $content["account"];
$nick = $_SESSION["nick"];

$account_content = get_user($nick);

include HEADER;
?>
<main class="container"
      role="main">  
  <div class="jumbotron">
    <h1><?= $title ?></h1>
    <table class="table">
<?php foreach ($account_content as $k => $v) { ?>
  
<?php } ?>
    </table>
  </div>
</main>
<?php 
include FOOTER;

