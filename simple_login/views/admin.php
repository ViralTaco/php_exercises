<?php
require_once realpath(__DIR__."/../controllers/init.php");
require_once realpath(__DIR__."/../controllers/admin.php");

// If no session is registered redirect to login page
if (!array_key_exists("nick", $_SESSION)
// If not admin redirect to login page.
|| !$is_admin) {
  header("Location: ".LOGIN_PHP);
} 

$title = $content["admin"];

$page_count = page_count();
if (!array_key_exists("page", $_GET)) {
  $page = 1;
} else {
  $page = intval($_GET["page"]);
}

$acc = get_accounts_table();
include HEADER;
?>
<main class="d-flex justify-content-center align-items-center bg-light"
      role="main">  
  <div class="jumbotron table-responsive col-md-10">
    <h1><?= $title ?></h1>
    <table class="table">
      <thead>
        <tr>
<?php foreach (get_accounts_columns() as $name) {
  if (array_key_exists($name, $content)) {
    $name = $content[$name];
  }
  echo '<th scope="col">'.$name.'</th>';
} ?>       
        </tr> 
      </thead>
      <tbody>
<?php 
foreach ($acc as $key => $row) { 
  if (empty($row)) {
    continue; 
  } else {
    $bg = ($row["isAdmin"]) ? 'class="table-danger"' : ''; 
?>
        <tr <?= $bg ?>>
          <th scope="row"><?= $row["id"] ?></th>
          <td><?= $row["username"] ?></td>
          <td><?= $row["mail"] ?></td>
          <td class="tools"></td>
        </tr>
<?php 
  } // else (row not empty) 
} ?>
      </tbody>
    </table>
    <nav aria-label="...">
      <ul class="pagination">
<?php 
$disabled = ($page > 1) ? "" : "disabled";
$previous = ($page > 1) ? $page - 1 : 1;
$next_disabled = ($page < $page_count) ? "" : "disabled";
$next = ($page < $page_count) ? $page : $page + 1;
?>
        <li class="page-item <?= $disabled ?>">
          <a class="page-link" href="?page=<?= $previous ?>" tabindex="-1"><?= $content["previous_page"] ?></a>
        </li>
<?php for ($i = 1; $i <= $page_count; ++$i) { 
  $active = ($page == $i) ? "active" : "";
?>        
        <li class="page-item <?= $active ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
<?php } ?>        
        <li class="page-item <?= $next_disabled ?>">
          <a class="page-link" href="?page=<?= $next ?>"><?= $content["next_page"] ?></a>
        </li>
      </ul>
    </nav>
  </div>
</main>
<?php
include FOOTER; 
