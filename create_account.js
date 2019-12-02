// $(document).ready(function () {
		
//   $('#sendButton').jqxButton({ width: 120, height: 25});
//   $('#acceptInput').jqxCheckBox({ width: 130});

//   $("#phoneInput").jqxMaskedInput({ mask: '(###)###-####', width: 150, height: 22});
//   $("#zipInput").jqxMaskedInput({ mask: '###-##-####', width: 150, height: 22});

//   $('.text-input').addClass('jqx-input');
//   $('.text-input').addClass('jqx-rc-all');
//   if (theme.length > 0) {
//     $('.text-input').addClass('jqx-input-' + theme);
//     $('.text-input').addClass('jqx-widget-content-' + theme);
//     $('.text-input').addClass('jqx-rc-all-' + theme);
//   }

//   var date = new Date();
//   date.setFullYear(1985, 0, 1);
//   $('#birthInput').jqxDateTimeInput({ width: 150, height: 22, value: $.jqx._jqxDateTimeInput.getDateTime(date) });

//   // initialize validator.
//   $('#form').jqxValidator({
//     rules: [
//     { input: '#userInput', message: 'Username is required!', action: 'keyup, blur', rule: 'required' },
//     { input: '#userInput', message: 'Your username must be between 3 and 12 characters!', action: 'keyup, blur', rule: 'length=3,12' },
//     { input: '#realNameInput', message: 'Real Name is required!', action: 'keyup, blur', rule: 'required' },
//     { input: '#realNameInput', message: 'Your real name must contain only letters!', action: 'keyup', rule: 'notNumber' },
//     { input: '#realNameInput', message: 'Your real name must be between 3 and 12 characters!', action: 'keyup', rule: 'length=3,12' },
//     {
//         input: '#birthInput', message: 'Your birth date must be between 1/1/1900 and 1/1/2012.', action: 'valueChanged', rule: function (input, commit) {
//       var date = $('#birthInput').jqxDateTimeInput('getDate');
//       $.ajax({
//       url: "create_account.php",
//       type: 'POST',
//       data: {birthInputYear: date.getFullYear()},
//       success: function(data)
//       {
//         if (data == "true")
//         {
//           commit(true);
//         }
//         else commit(false);
//       },
//       error: function()
//       {
//         commit(false);
//       }
//     });
//     }
//     },
//     { input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
//     { input: '#passwordInput', message: 'Your password must be between 4 and 12 characters!', action: 'keyup, blur', rule: 'length=4,12' },
//     { input: '#passwordConfirmInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
//     { input: '#passwordConfirmInput', message: 'Passwords doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
//       // call commit with false, when you are doing server validation and you want to display a validation error on this field. 
//       if (input.val() === $('#passwordInput').val()) {
//         return true;
//       }
//         return false;
//       }
//     },
//     { input: '#emailInput', message: 'E-mail is required!', action: 'keyup, blur', rule: 'required' },
//     { input: '#emailInput', message: 'Invalid e-mail!', action: 'keyup', rule: 'email' },
//     { input: '#phoneInput', message: 'Invalid phone number!', action: 'valuechanged, blur', rule: 'phone' },
//     { input: '#zipInput', message: 'Invalid zip code!', action: 'valuechanged, blur', rule: 'zipCode' }]
//   });

//   // validate form.
//   $("#sendButton").click(function () {
//     var validationResult = function (isValid) {
//       if (isValid) {
//         $("#form").submit();
//       }
//     }
//     $('#form').jqxValidator('validate', validationResult);
//   });

//   $("#form").on('validationSuccess', function () {
//     $("#form-iframe").fadeIn('fast');
//   });
// });



      function phoneTest(){
        var temp = $("#phoneInput").jqxMaskedInput('val');
        alert(temp);
      }
