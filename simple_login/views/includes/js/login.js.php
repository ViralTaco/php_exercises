'use strict';
function failShake(response) {
  $('#login-div').effect('shake', () => {
    $('#login-form').fadeIn('fast')
                    .prepend(`
      <!-- failure -->        
      <div class="alert alert-danger" 
           id="error-message"
           role="alert">${response}</div>
    `) // prepend
  });
}

function submitForm() {
  const nick = $('#nick').val();
  const pass = $('#pass').val();
<?php if ($is_signup): ?>    
  const mail = $('#mail').val();
  const conf = $('#pass-conf').val();
  
  if (pass !== conf) {
    failShake();
    return false;
  }
<?php endif; ?>
  $.ajax({
      url: '<?= $action_php ?>'
  ,  type: 'POST'
  ,  data: {
       nick: nick 
    ,  pass: pass
<?php if ($is_signup): ?>
    ,  conf: conf
    ,  mail: mail
<?php endif; ?>
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
