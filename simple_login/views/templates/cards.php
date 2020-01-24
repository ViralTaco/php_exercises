<?php
require_once realpath(__DIR__."/../../controllers/init.php");
require_once realpath(__DIR__."/../../models/card.php");

/**
 * 
 * This file contains the view (template) for cards
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

/*
 * $cards = Array(Card);
 */
ob_start();

if (!isset($cards)) {
  header("Location: ".ER404_PHP);
  exit();
}

foreach ($cards as $key => $card) { ?>
<!-- card: <?= ($key + 1).' ('.$card->title.')' ?> -->
<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
    <img class="card-img-top" <?= $card->img ?>>
    <div class="card-body">
      <p class="card-text"><?= $card->content ?></p>
    </div>
  </div>
</div>  
<?php }
ob_end_flush();