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
<main class="d-flex justify-content-center align-items-center bg-light"
      role="main">  
  <div class="jumbotron col-md-6">
    <h1><?= $title ?></h1>
    <table class="table">
<?php foreach ($account_content as $key => $value) { ?>
    <tr>
      <th scope="row"><?= $content[$key] ?></th>
      <br>
      <td><?= $value ?></td>
      <td class="tools"></td>
    </tr>
<?php } ?>
    </table>
  </div>
</main>
<?php 
include FOOTER;

