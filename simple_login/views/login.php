<?php 
require_once realpath(__DIR__."/../controllers/init.php");

if (array_key_exists("nick", $_SESSION)) {
  header("Location: ".INDEX_PHP);
}

if (!isset($is_signup) || !$is_signup) {
  $is_signup = false;
  $action_php = CONNECT_PHP;
  $action_str = $content["login"];
  $btn_class = "btn-success";
} else {
  $action_php = REGISTER_PHP;
  $action_str = $content["signup"];
  $btn_class = "btn-info";
}

// Set the title. 
$title = $action_str;
// login.js buffer 
ob_start(); 
?>
<!-- login js -->
<script type="text/javascript">
  function failShake(response) {
    $('#login-div').effect('shake')
                   .complete(
      $('#login-form').fadeIn('fast')
                      .prepend(`<!-- failure -->        
        <div class="alert alert-danger" 
              id="error-message"
              role="alert">${response}</div>`
      )
    );
  }
  
  function submitForm() {
    const nick = $('#nick').val();
    const pass = $('#pass').val();
<?php if ($is_signup) { ?>    
    const mail = $('#mail').val();
    const conf = $('#pass-conf').val();
    
    if (pass !== conf) {
      failShake();
      return false;
    }
<?php } ?>
    $.ajax({
        url: '<?= $action_php ?>'
    ,  type: 'POST'
    ,  data: {
         nick: nick 
      ,  pass: pass
<?php if ($is_signup) { ?>
      ,  conf: conf
      ,  mail: mail
<?php } ?>
      }
    });
    
    return true;
  }
  
  $(() => {
    $('#login-form').on("submit", (event) => {
      event.preventDefault();
      $('#error-message').fadeOut(100).remove();
      submitForm();
    });
    
    $(document).ajaxSuccess((event, xhr, settings) => {
      if (settings.url !== '<?= $action_php ?>') {
        return;
      }
      
      const response = xhr.responseText;
      if (response === '<?= SUCCESS ?>') {
        $('#login-div').fadeOut(300, () => {
          $('#success').fadeIn('fast')
                       .delay(900)
                       .fadeOut('fast', () => { 
            window.location = '<?= INDEX_PHP ?>'; 
          });
        });
        
      } else {
        failShake(response);
      }
    });
  });
</script>

<?php
$login_php = ob_get_clean();

include HEADER; 
include FORMS;
include FOOTER;