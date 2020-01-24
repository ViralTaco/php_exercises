<?php
require_once realpath(__DIR__."/../../controllers/init.php");

/**
 * 
 * This file contains the view (template) for the 404/"We're sorry" page
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

if (!isset($sorry_head) || !isset($sorry_content)) {
  header("Location: ".ER404_PHP);
  exit();
}
?>

<!-- Courtesy of mylastof (https://bootsnipp.com/snippets/qr73D) -->
<main class="d-flex justify-content-center align-items-center" 
      id="main"
      style="height: 100vh;">
  <h1 class="align-top inline-block align-content-center">
    <?= $sorry_head ?>
  </h1>
  <div class="inline-block align-middle">
    <h2 class="font-weight-normal lead" 
        id="desc"><?= $sorry_content ?></h2>
  </div>
</main>