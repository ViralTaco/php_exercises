<?php
session_start();

require_once "./internals/constants.php";

if (isset($_SESSION["nick"])) {
  header("Location: ".INDEX_PHP);
}

ob_start(); 
?>

<script type="text/javascript">
  function submitForm() {
    const nick = $('#nick').val();
    const pass = $('#pass').val();

    $.ajax({
        url: '<?= CONNECT_PHP ?>'
    ,  type: 'POST'
    ,  data: {nick: nick, pass: pass}
    });
    
    return true;
  }
  
  $(() => {
    $(document).ajaxSuccess((event, xhr, settings) => {
      const response = xhr.responseText;
      if (response == '1') {
        $('#login-div').fadeOut(300, () => {
          $('#success').fadeIn('fast').delay(900).fadeOut('fast', () => { 
            window.location = '<?= INDEX_PHP ?>'; 
          });
        });
        
      } else {
        $('#login-div').effect('shake');
      }
    });
  });
</script>

<?php
$login_php = ob_get_clean();
$title = "Connection";
?>

<!-- Header -->
<?php include HEADER; ?>

<form class="form-signin text-center choice" 
      id="login-form"
      method="POST"
<?php if (!isset($login_php)) { ?>
        action="<?= CONNECT_PHP ?>"
<?php } else { ?>
        action="javascript: submitForm();"
<?php } ?>
      >
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
  <div id="login-div">
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
    <button class="btn btn-lg btn-success btn-block" 
            type="submit">Connection</button>
  </div>
</form>
<!-- Footer -->
<?php include FOOTER;