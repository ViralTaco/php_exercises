<?php 
require_once "./internals/init.php";

$title = $content["home"];
include HEADER; ?>

<div class="hero text-white text-left"
     style="background-image: url(<?= ROOT_URL.'/img/computer.jpg' ?>);">
  <h1 class="display-5"><?= $content["brand"].' '.$content["what_we_do"] ?></h1>
  <p class="lead my-3">
<?php if ($lang === 'fr') { ?>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
    Odio ut sem nulla pharetra diam. En Français
<?php } elseif ($lang === 'en') { ?>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
    Odio ut sem nulla pharetra diam. In English
<?php } ?>
  </p>
</div>  
<?php include FOOTER;