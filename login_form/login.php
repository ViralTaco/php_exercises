<?php
/**
 * This file contains the view for the login form
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

require_once "./internals/constants.php";
ob_start(); 
?>
  <script type="text/javascript">
    $(() => {
      $('#login-form').submit = (event) => {
        event.preventDefault();
        const nick = $('#nick').val();
        const pass = $('#pass').val();

        $.ajax({
           type: 'post'
        ,  url: '<?php echo CONNECT_PHP; ?>'
        ,  data: {nick:nick,pass:pass}
        ,  success: (data) => {
            if ($.trim(data) === '1') {
              $('main').html = `
                <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                  <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                  <span class="swal2-success-line-tip"></span>
                  <span class="swal2-success-line-long"></span>
                  <div class="swal2-success-ring"></div> 
                  <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                  <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>`;
            } else {
              alert('Nom d\'utilisateur ou mot de pass incorrecte.');
            }
          }   
        });
      }
    });
  </script>
<?php
//$login_php = ob_get_clean();
$title = "Connection";
include HEADER;
?>

<form class="form-signin text-center" 
      id="login-form"
      name="login-form"
      method="POST"
<?php if (!isset($login_php)) { ?>
        action="<?php echo CONNECT_PHP; ?>"
<?php } ?>
>
  <h1 class="h3 mb-3 font-weight-normal"><? echo $title; ?></h1>
  <label for="nick" 
         class="sr-only">Nom d'utilisateur</label>
  <input type="text" 
         id="nick" 
         name="nick" 
         class="form-control" 
         placeholder="Nom d'utilisateur" 
         required 
         autofocus>
  <label for="pass" 
         class="sr-only">Password</label>
  <input type="password" 
         id="pass" 
         name="pass" 
         class="form-control" 
         placeholder="Mot de passe" 
         required>
  <button class="btn btn-lg btn-primary btn-block" 
          type="submit"
          id="connect">Connection</button>
</form>

<?php
include FOOTER;