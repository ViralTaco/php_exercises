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
  function failShake() {
    $('#login-div').effect('shake');
  }
  
  function submitForm() {
    const nick = $('#nick').val();
    const pass = $('#pass').val();

<?php if ($is_signup) { ?>    
    const mail = $('#mail').val();

    if (pass !== $('#pass-conf').val()) {
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
      ,  mail: mail
<?php } ?>
      }
    });
    
    return true;
  }
  
  $(() => {
    $(document).ajaxSuccess((event, xhr, settings) => {
      if (settings.url !== '<?= $action_php ?>') {
        return;
      }
      
      const response = xhr.responseText;
      if (response === '1') {
        $('#login-div').fadeOut(300, () => {
          $('#success').fadeIn('fast').delay(900).fadeOut('fast', () => { 
            window.location = '<?= INDEX_PHP ?>'; 
          });
        });
        
      } else if (response === '2') {
        //TODO: Handle wrong email
      } else {
        failShake();
      }
    });
  });
</script>

<?php
// set $login_php to add js to header. 
// because of a compatibility issue with firefox this script
// can't be used anymore. The connection process will now be php only. 
// until we need the script again we'll need to clean the buffer instead.
//$login_php = ob_get_clean();
ob_end_clean();

include HEADER; 
include FORMS;
include FOOTER;