<?php 
require_once realpath(__DIR__."/../controllers/init.php");

$title = $content["404_title"];
// set error 404
header(HEADER_404_STR); 

include HEADER; ?>
<!-- Courtesy of mylastof (https://bootsnipp.com/snippets/qr73D) -->
  <main class="d-flex justify-content-center align-items-center" 
        id="main"
        style="height: 100vh;">
    <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
    <div class="inline-block align-middle">
      <h2 class="font-weight-normal lead" 
          id="desc"><?= $content["404_message"] ?></h2>
    </div>
<?php 
include FOOTER; 