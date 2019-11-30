<?php
// check whether the entered year is in the range of 1900 - 2012
function executePost(&$con,&$sql) {
	if (mysqli_query($con,$sql)) {
		echo "Success";
	} else {
		echo "Error" . mysqli_error($con);
	}
	echo("<br>");
}
function executeGet(&$con,&$sql,&$result) {
	$result = mysqli_query($con,$sql);
	if ($result) {
		echo "Success";
	} else {
		echo "Error" . mysqli_error($con);
	}
	echo("<br>");
}


$servername = "149.28.55.25";
$username = "websysroot";
$password = "craftlink.rootbeer";
$dbname = "CraftLink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
}

$valid = false;
//$submitting = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['realname'])
		&& isset($_POST['email']) && isset($_POST['phone']) ) {

	$formData = array(
		"username" => $_POST["username"],
		"password" => $_POST["password"],
		"email" => $_POST["email"],
		"phone" => $_POST["phone"],
		"acceptterms" => $_POST["acceptterms"],
		"suppliertype" => $_POST["suppliertype"],
		"consumertype" => $_POST["consumertype"]
	);
	// check whether the terms are accepted.
	if ($formData['acceptterms'] != 'true') {
		$response = "<p><h1>Registration Not Successful</h1></p><p>You need to accept the terms.</p>";
		echo $response;
		return;
	}
	// the registration is successful only if the username is 'admin' and the password is 'admin123'.
	/*
	if ($formData['username'] == 'admin' && $formData['password'] == 'admin123') {
		$response = "<p><h1>Registration Successful</h1></p><p></p>";
		$response.= "Username:" . $formData['username'].= "<br/>";
		$response.= "Password:" . $formData['password'].= "<br/>";
		// $response.= "Real name:" . $formData['realname'].= "<br/>";
		// $response.= "Birth date:" . $formData['birthdate'].= "<br/>";
		$response.= "E-mail:" . $formData['email'].= "<br/>";
		$response.= "Phone:" . $formData['phone'].= "<br/>";
		// $response.= "Zip code:" . $formData['zip'].= "<br/>";
		$response.= "Supplier?" . $formData['suppliertype'].= "<br/>";
		$response.= "Consumer?" . $formData['consumertype'].= "<br/>";
	} else {
		$response = "<p><h1>Registration Not Successful</h1></p><p>Invalid username or password.</p>";
	}
	echo $response;
	*/

	///$submitting = true;
}

echo $valid;
if ($valid) {
	echo "VALID";
	echo $valid;
	$passwordhash = password_hash($formData['suppliertype'], PASSWORD_DEFAULT);
	echo $passwordhash;

	$result = NULL;
	$sql = 'INSERT INTO CraftLink.user (`username`, `email`, `passwordhash`, `product_dscpt`, `is_supplier`, `phonenumber`)
	VALUES (\''
	. $formData['username'] . '\',\''
	. $formData['email'] . '\',\''
	. $passwordhash . '\',\''
	. $formData['suppliertype'] . '\',\''
	. $formData['phone'] . '\')';
	//$resultAddP = $conn->query($sqlAddP);
	executePost($conn, $sql, $result);
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resources/css/master.css">
    <link rel="stylesheet" href="jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxvalidator.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxdatetimeinput.js"></script>
		<script type="text/javascript" src="jqwidgets/jqwidgets/jqxmaskedinput.js"></script>
		<script type="text/javascript" src="jqwidgets/jqwidgets/jqxradiobutton.js"></script>
    <script type="text/javascript" src="jqwidgets/scripts/demos.js"></script>       <!-- commented out Angular components -->

		<script type="text/javascript">
			$(document).ready(function () {
			
			$('#sendButton').jqxButton({ width: 120, height: 25});
			$('#acceptInput').jqxCheckBox({ width: 130});
			$('#consumer').jqxRadioButton({ width: 250, height: 25, checked: true});
			$("#supplier").jqxRadioButton({ width: 250, height: 25});
		
			$("#phoneInput").jqxMaskedInput({ mask: '(###)###-####', width: 150, height: 22});
			// $("#zipInput").jqxMaskedInput({ mask: '###-##-####', width: 150, height: 22});
		
			$('.text-input').addClass('jqx-input');
			$('.text-input').addClass('jqx-rc-all');
			if (theme.length > 0) {
				$('.text-input').addClass('jqx-input-' + theme);
				$('.text-input').addClass('jqx-widget-content-' + theme);
				$('.text-input').addClass('jqx-rc-all-' + theme);
			}
		
			var date = new Date();
			date.setFullYear(1985, 0, 1);
		
			// initialize validator.
			$('#form').jqxValidator({
				rules: [
				{ input: '#userInput', message: 'Username is required!', action: 'keyup, blur', rule: 'required' },
				{ input: '#userInput', message: 'Your username must be between 3 and 12 characters!', action: 'keyup, blur', rule: 'length=3,12' },
				{ input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
				{ input: '#passwordInput', message: 'Your password must be between 4 and 12 characters!', action: 'keyup, blur', rule: 'length=4,12' },
				{ input: '#passwordConfirmInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
				{ input: '#passwordConfirmInput', message: 'Passwords doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
					// call commit with false, when you are doing server validation and you want to display a validation error on this field. 
					if (input.val() === $('#passwordInput').val()) {
						return true;
					}
						return false;
					}
				},
				{ input: '#emailInput', message: 'E-mail is required!', action: 'keyup, blur', rule: 'required' },
				{ input: '#emailInput', message: 'Invalid e-mail!', action: 'keyup', rule: 'email' },
				{ input: '#phoneInput', message: 'Invalid phone number!', action: 'valuechanged, blur', rule: 'phone' }/*,
			{ input: '#zipInput', message: 'Invalid zip code!', action: 'valuechanged, blur', rule: 'zipCode' }*/]
			});
		
			// validate form.
			$("#sendButton").click(function () {
				var validationResult = function (isValid) {
					if (isValid) {
						//$("#form").submit();
						window.location.href = "create_account.php?valid=" + isValid;

					}
				}
				$('#form').jqxValidator('validate', validationResult);
			});
		
			$("#form").on('validationSuccess', function () {
				$("#form-iframe").fadeIn('fast');
			});
		});
		</script>
    <title>Create Account</title>


  </head>
  <body>
    <!--img src=LOGO -->
    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li class="right"><a href="#">SIGN UP</a></li>
        <li class="right"><a href="supplier_login.php">Login Root Brewers</a></li>
        <li class="right"><a href="consumer_login.php">Login Customers</a></li>
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div>

    <h2 class="centerMe" >Register with CraftLink Today!</h2>
    <div class="white-block">
      <form class="form_reg" id="form" target="form-iframe"  method="post" action="create_account.php" style="font-size: 13px; font-family: Verdana; width: 650px;">
            
	      <table class="register-table">
					<tr>
						<td>Username:</td>
						<td><input name="username" type="text" id="userInput" class="text-input" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input name="password" type="password" id="passwordInput" class="text-input" /></td>
					</tr>
					<tr>
						<td>Confirm password:</td>
						<td><input type="password" id="passwordConfirmInput" class="text-input" /></td>
					</tr>
					<tr>
						<td>E-mail:</td>
						<td><input name="email" type="text" id="emailInput" class="text-input" /></td>
					</tr>
					<tr>
						<td>Phone:</td>
						<td><div name="phone" id="phoneInput"></div></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: left;">
							<div name="suppliertype" id="supplier">Supplier</div>
							<div name="consumertype" id="consumer">Consumer</div>
						</td>
					</tr>
					<tr>
							<td colspan="2" style="text-align: ;"><div name="acceptterms" id="acceptInput" class="rememberme_div">I accept terms</div></td>
					</tr>
					<tr>
							<td colspan="2" style="text-align: center;"><input type="button" value="Create Account" id="sendButton" /></td>
					</tr>
				</table>
				<div class="prompt">*For successful registration, username=admin, password=admin123</div>
			</form>
        <!--iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe-->
    </div>


  </body>
</html>