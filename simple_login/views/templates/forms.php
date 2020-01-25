<main id="main"
      role="main">  
<form class="form-signin text-center choice" 
      id="login-form"
      method="POST"
      action="<?= $action_php ?>">
<?php if (isset($GLOBALS["error_message"])) { ?>      
<!-- failure -->
  <div class="alert alert-danger" role="alert">
    <?= $error_message ?>
  </div>      
<?php } ?>
<!-- success animation -->
  <div id="success"
       class="hidden">
    <div class="swal2-icon swal2-success swal2-animate-success-icon" 
         style="display: flex;">
      <div class="swal2-success-circular-line-left"></div>
      <span class="swal2-success-line-tip"></span>
      <span class="swal2-success-line-long"></span>
      <div class="swal2-success-ring"></div>
      <div class="swal2-success-fix"></div>
      <div class="swal2-success-circular-line-right"></div>
    </div>
  </div>
<!-- login form -->  
  <div id="login-div">
<!-- username -->  
    <label for="nick" 
           class="sr-only"><?= $content["username"] ?></label>
    <input type="text" 
           id="nick" 
           name="nick"
           class="form-control" 
           placeholder="<?= $content['username'] ?>"
           required 
           autofocus>
<?php if ($is_signup) { ?>         
<!-- email -->          
    <label for="mail" 
           class="sr-only"><?= $content["mail"] ?></label>
    <input type="email" 
           id="mail" 
           name="mail"
           class="form-control" 
           placeholder="<?= $content['mail'] ?>"
           required>
<?php } ?>
<!-- password -->
    <label for="pass" 
           class="sr-only"><?= $content["password"] ?></label>
    <input type="password" 
           id="pass"
           name="pass"
           class="form-control" 
           placeholder="<?= $content['password'] ?>"
           required>
<?php if ($is_signup) { ?>
<!-- confirm password -->
    <label for="pass-conf" 
           class="sr-only"><?= $content["confirm_pass"] ?></label>
    <input type="password" 
           id="pass-conf"
           name="pass-conf"
           class="form-control" 
           placeholder="<?= $content['confirm_pass'] ?>"
           required>
<?php } ?>          
    <button class="btn btn-lg btn-block <?= $btn_class ?>" 
            type="submit"><?= $action_str ?></button>
  </div>
</form></main>