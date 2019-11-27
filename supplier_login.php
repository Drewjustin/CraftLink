<?php
$formData = array(
		"username" => $_POST["username"],
		"password" => $_POST["password"]
	);
	
	if($formData['username'] == 'admin' && $formData['password'] == 'admin123') {
		// get the checked state of the checkbox with name - "rememberme". The value could be true - 
		if($formData['rememberme'] == 'true') {
			$response = "<p><h1>Login Successful</h1></p><p>We'll keep you logged in on this computer.</p>";
			}
		else {
			$response = "<p><h1>Login Successful</h1></p><p>We won't keep you logged in on this computer.</p>";
		}
	}
	else {
		$response = "<p><h1>Login Not Successful</h1></p><p>Invalid username or password.</p>";
	}

	echo $response;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resources/css/master.css">
    <link rel="stylesheet" href="jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="jqwidgets/scripts/demos.js"></script>

		<title>Supplier Login</title>
		
		<script type="text/javascript">
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
		</script>


  </head>
  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <a href="index.html">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.html">HOME</a></li>
        <li class="right"><a href="create_account.php">SIGN UP</a></li>
        <li class="right"><a href="#">Login Root Brewers</a></li>
        <li class="right"><a href="consumer_login.php">Login Customers</a></li>
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div>

    <h2 class="centerMe">Supplier Login</h2>
    <div class="register-block" style="font-size: 13px; font-family: Verdana;">
      <form class="form" id="form" target="form-iframe" method="post" action="supplier_login.php" style="width: 650px;">

          <label>Username:</label>
          <div>
              <input type="text" id="username" name="username" />
          </div>
          <label>Password:</label>
          <div>
              <input type="password" id="password" name="password" />
          </div>
          <div class="rememberme_div">
              <div name="rememberme" id="rememberme">Remember Me</div>
          </div>
          <div>
              <input id="loginButton" type="submit" value="Login" />
              <!-- ADDED BUTTON FOR DEMO PURPOSES -->
              <button type="button" name="button" onclick="window.location.href='supplier.php'">Demo login</button>
          </div>
          <div class="prompt">*For successful login, username=admin, password=admin123</div>
      </form>
      <!--iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe-->
  </div>


  </body>
</html>
