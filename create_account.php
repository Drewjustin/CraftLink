<?php
// connect to db

$servername = "149.28.55.25";
$username = "websysroot";
$password = "craftlink.rootbeer";
$dbname = "CraftLink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
	 echo "connection failed";
} else {
	echo "connection successful";
}

?>

<?php 
  // form processing
  
  // variables to hold form values:
  $firstNames = '';  
  $password1 = '';
  $password2 = '';
  $email = '';
  $phoneNum = '';
  $userType = '';
  $acceptterms = '';



  // hold any error messages
  $errors = ''; 
  

  // is form submitted/posted 
  $havePost = isset($_POST["save"]);
  
  if ($havePost) {
    // get and clean form entries
    $firstNames = htmlspecialchars(trim($_POST["firstNames"])); 
    $password1 = htmlspecialchars(trim($_POST["password1"]));
    $password2 = htmlspecialchars(trim($_POST["password2"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phoneNum = htmlspecialchars(trim($_POST["phoneNum"]));
    $userType = htmlspecialchars(trim($_POST["userType"])); // "supplier" or "consumer"
    if(isset($_POST["terms"])) $acceptterms = htmlspecialchars(trim($_POST["terms"]));
    //echo $acceptterms;

    
    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array
    
    if ($firstNames == '') {
      $errors .= '<li>Username is required</li><br>';
      if ($focusId == '') $focusId = '#firstNames';
    }
    if (strlen($firstNames) < 4 || strlen($firstNames) > 12) {
      $errors .= '<li>Username must be between 4 and 12 characters long</li><br>';
      if ($focusId == '') $focusId = '#firstNames';
    }

    if ($password1 == '') {
      $errors .= '<li>Password is required</li><br>';
      if ($focusId == '') $focusId = '#password1';
    }
    if (strlen($password1) < 4 || strlen($password1) > 12) {
      $errors .= '<li>Password must be between 4 and 12 characters long</li><br>';
      if ($focusId == '') $focusId = '#password1';
    }

    if ($password2 != $password1) {
      $errors .= '<li>Passwords do not match</li><br>';
      if ($focusId == '') $focusId = '#password2';
    }

    if ($email == '') {
      $errors .= '<li>Email is required</li><br>';
      if ($focusId == '') $focusId = '#email';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $errors .= '<li>Invalid email format</li><br>';
      if ($focusId == '') $focusId = '#email';
	}

	if ($phoneNum == '') {
      $errors .= '<li>Phone Number is required</li><br>';
      if ($focusId == '') $focusId = '#phoneNum';
    }
	if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNum)) {
      $errors .= '<li>Invalid phone number</li><br>';
      if ($focusId == '') $focusId = '#phoneNum';
	}
	if ($acceptterms == '') {
      $errors .= '<li>Please accept the terms and conditions</li><br>';
      if ($focusId == '') $focusId = '#acceptterms';
    }

  
  	// post errors if there are any
    if ($errors != '') { ?>
      <div id="messages">
        <h4>Please correct the following errors:</h4>
        <ul>
          <?php echo $errors; ?>
        </ul>
        <script type="text/javascript">
          $(document).ready(function() {
            $("<?php echo $focusId ?>").focus();
          });
        </script>
      </div>
    <?php } else { ?> 
      <div id="messages">
        <!-- <h4>submitted (no errors)</h4> -->
      </div>
    <?php } 
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
   <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
   
    <script type="text/javascript" src="create_account.js"></script>  
		<script type="text/javascript">
			$(document).ready(function () {
			
			// old jqx initialization stuff =============================

			//$('#sendButton').jqxButton({ width: 120, height: 25});
			//$('#acceptInput').jqxCheckBox({ width: 130});
			//$('#consumer').jqxRadioButton({ width: 250, height: 25, checked: true});
			//$("#supplier").jqxRadioButton({ width: 250, height: 25});
		
			//$("#phoneInput").jqxMaskedInput({ mask: '(###)###-####', width: 150, height: 22});
			// $("#zipInput").jqxMaskedInput({ mask: '###-##-####', width: 150, height: 22});
		
			//$('.text-input').addClass('jqx-input');
			//$('.text-input').addClass('jqx-rc-all');
			// if (theme.length > 0) {
			// 	$('.text-input').addClass('jqx-input-' + theme);
			// 	$('.text-input').addClass('jqx-widget-content-' + theme);
			// 	$('.text-input').addClass('jqx-rc-all-' + theme);
			// }
		
			//var date = new Date();
			//date.setFullYear(1985, 0, 1);



		
			// initialize validator.
			// $('#form').jqxValidator({
			// 	rules: [
			// 	{ input: '#userInput', message: 'Username is required!', action: 'keyup, blur', rule: 'required' },
			// 	{ input: '#userInput', message: 'Your username must be between 3 and 12 characters!', action: 'keyup, blur', rule: 'length=3,12' },
			// 	{ input: '#passwordInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			// 	{ input: '#passwordInput', message: 'Your password must be between 4 and 12 characters!', action: 'keyup, blur', rule: 'length=4,12' },
			// 	{ input: '#passwordConfirmInput', message: 'Password is required!', action: 'keyup, blur', rule: 'required' },
			// 	{ input: '#passwordConfirmInput', message: 'Passwords doesn\'t match!', action: 'keyup, focus', rule: function (input, commit) {
			// 		// call commit with false, when you are doing server validation and you want to display a validation error on this field. 
			// 		if (input.val() === $('#passwordInput').val()) {
			// 			return true;
			// 		}
			// 			return false;
			// 		}
			// 	},
			// 	{ input: '#emailInput', message: 'E-mail is required!', action: 'keyup, blur', rule: 'required' },
			// 	{ input: '#emailInput', message: 'Invalid e-mail!', action: 'keyup', rule: 'email' },
			// 	{ input: '#phoneInput', message: 'Invalid phone number!', action: 'valuechanged, blur', rule: 'phone' }/*,
			// { input: '#zipInput', message: 'Invalid zip code!', action: 'valuechanged, blur', rule: 'zipCode' }*/]
			// });
		
			// // validate form.
			// $("#sendButton").click(function () {
			// 	var validationResult = function (isValid) {
			// 		if (isValid) {
			// 			//$("#form").submit();
			// 			window.location.href = "create_account.php?valid=" + isValid;

			// 		}
			// 	}
			// 	$('#form').jqxValidator('validate', validationResult);
			// });
		
			// $("#form").on('validationSuccess', function () {
			// 	$("#form-iframe").fadeIn('fast');
			// });
		});
		</script>
    <title>Create Account</title>


  </head>
  <body>

  	<pre id="errors">
  		




  	</pre>


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
           <fieldset> 
		    <legend>Register</legend>
		    <div class="formData">
		                    
		      <label class="field" for="firstNames">Username:</label>
		      <div class="value"><input type="text" size="60" value="<?php echo $firstNames; ?>" name="firstNames" id="firstNames"/></div>
		      
		      
		      <label class="field" for="password1">Password:</label>
		      <div class="value"><input type="password" size="60" value="<?php echo $password1; ?>" name="password1" id="password1"/></div>
		      
		      <label class="field" for="password2">Confirm Password:</label>
		      <div class="value"><input type="password" size="60" value="<?php echo $password2; ?>" name="password2" id="password2"/></div>
		      
		      <label class="field" for="email">Email:</label>
		      <div class="value"><input type="text" size="60" value="<?php echo $email; ?>" name="email" id="email"/></div>
		      
		      <label class="field" for="phoneNum">Phone (XXX-XXX-XXXX):</label>
		      <div class="value"><input type="text" size="60" value="<?php echo $phoneNum; ?>" name="phoneNum" id="phoneNum"/></div>
		      

		      <input type="radio" id="supplier" name="userType" value="supplier" checked /> Supplier<br/>
  			  <input type="radio" id="consumer" name="userType" value="consumer" /> Consumer<br/>


		      <label class="field" for="acceptInput">Terms and Conditions:</label>
		      <div class="value"><input type="checkbox" id="acceptterms" name="terms" value="acceptterms" /> I accept the terms</div>

		      




		      <input type="submit" value="Create Account" id="save" name="save"/>
		    </div>
		  </fieldset>



	     <!--  <table class="register-table">
					OLD JQX FORM =============================

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
					<tr><td>
							<br><div id="testpls" onclick="phoneTest()">test</div></td></tr>
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
							<td colspan="2" style="text-align: center;"><input type="submit" value="Create Account" id="sendButton" /></td>
					</tr>
				</table>
				<div class="prompt">*For successful registration, username=admin, password=admin123</div> -->
			</form> 
    </div>





    <div id="bodyBlock">



<?php if($havePost && $errors == '') { 
	// TODO: hash the password first
	$createTime = time() + (7 * 24 * 60 * 60);
	$query = "INSERT INTO `user` (`username`, `email`, `passwordhash`, `create_time`, `user_id`, `phonenumber`) VALUES ('$firstNames', '$email', '$password1', now(), NULL, '$phoneNum')";
	$result0 = $conn->query($query);
	if (!$result0) {
    		trigger_error('Invalid query: ' . $conn->error);
		}

  if ($conn->connect_error) {
    echo '<div class="messages">Error: ';
    echo $conn->connect_errno . ' - ' . $db->connect_error . '</div>';
	}



	$query1 = "SELECT * FROM `user`";
    	$result = $conn->query($query1);

    	if (!$result) {
    		trigger_error('Invalid query: ' . $conn->error);
		}

    	if ($conn->connect_error) {
		    echo '<div class="messages">Error: ';
		    echo $conn->connect_errno . ' - ' . $db->connect_error . '</div>';
		}
    	$numCourses = $result->num_rows;

    	for($i = 0; $i < $numCourses; $i++){
    		$course = $result->fetch_assoc();
    		$title = $course['username'];

    		$email = $course['email'];
    		$pass = $course['passwordhash'];
    		$phone = $course['phonenumber'];
    		$uid = $course['user_id'];
    		$time = $course['create_time'];


    		echo '<div class="course_title">' . $title . ' ' . $email . ' ' . $pass . ' ' . $phone . ' ' . $uid . ' ' . $time . '</div><br>';
    	}
}

?>




      
    </div>


  </body>
</html>