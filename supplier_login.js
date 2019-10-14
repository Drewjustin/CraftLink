$(document).ready(function () {
            
  $("#username, #password").addClass('jqx-input');
  if (theme != '') {
      $("#username, #password").addClass('jqx-input-' + theme);
  }
  $("#rememberme").jqxCheckBox({ width: 130});
  $("#loginButton").jqxButton({theme: theme});

  // add validation rules.
  $('#form').jqxValidator({
      rules: [
             { input: '#username', message: 'Username is required!', action: 'keyup, blur', rule: 'required' },
             { input: '#username', message: 'Your username must start with a letter!', action: 'keyup, blur', rule: 'startWithLetter' },
             { input: '#username', message: 'Your username must be between 3 and 12 characters!', action: 'keyup, blur', rule: 'length=3,12' },
             { input: '#password', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
             { input: '#password', message: 'Your password must be between 4 and 12 characters!', action: 'keyup, blur', rule: 'length=4,12' }
      ]
             
  });
  // validate form.
  $("#loginButton").click(function () {
      $('#form').jqxValidator('validate');
  });

  $("#form").on('validationSuccess', function () {
      $("#form-iframe").fadeIn('fast');
  });
});