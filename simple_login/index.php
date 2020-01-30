<?php
require_once realpath(__DIR__."/controllers/init.php");
require_once realpath(__DIR__."/models/Card.php");

$title = $content["home"];
define("IMG_URL", ROOT_URL."/views/includes/img");
include HEADER; 
?>
<main id="main"
      role="main">  
  <div class="hero text-white text-left"
        style="background-image: url(<?= IMG_URL.'/computer.jpg' ?>);">
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
<!-- cards -->  
  <div class="py-5">
    <div class="container">
      <div class="row">
<?php

$card_content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br>
  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
  Odio ut sem nulla pharetra diam.";
$cards = [];
for ($i = 0; $i < 3; ++$i) {
  $cards[$i] = new Card("Title ".($i + 1),  
                        $card_content, 
                        "https://via.placeholder.com/300x190/55595c/eceeef/?text=Placeholder");
}

include CARDS;
echo '</div></div></div></main>';
include FOOTER;