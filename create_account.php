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
	 //echo "connection failed";
} else {
	//echo "connection successful";
}

  // form processing

  // variables to hold form values:
  $userName = '';
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
    // get and clean form entries, not cleanining passwords as they will be hashed and
	 // password could have special chars so that will not be trimmed
    $userName = htmlspecialchars(trim($_POST["userName"]));
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    $email = htmlspecialchars(trim($_POST["email"]));
    $phoneNum = htmlspecialchars(trim($_POST["phoneNum"]));
	 $userType = htmlspecialchars(trim($_POST["userType"])); // "supplier" or "consumer"
	 $userTypeCode = ($userType=="supplier")?1:0;
    if(isset($_POST["terms"])) $acceptterms = htmlspecialchars(trim($_POST["terms"]));


    $focusId = ''; // trap the first field that needs updating, better would be to save errors in an array

    if ($userName == '') {
      $errors .= '<li>Username is required</li><br>';
      if ($focusId == '') $focusId = '#userName';
    }
    if (strlen($userName) < 4 || strlen($userName) > 12) {
      $errors .= '<li>Username must be between 4 and 12 characters long</li><br>';
      if ($focusId == '') $focusId = '#userName';
    }

    // check if username exists in table
    $checkUsername = "SELECT * FROM `user` WHERE `username` = '$userName'";
    $resultUsername = $conn->query($checkUsername);

	 if (!$resultUsername) { // print if there's an error w/ the query
		trigger_error('Invalid query: ' . $conn->error);
	} else if ($resultUsername->num_rows != 0){ // add error if the username is duplicate
	  $errors .= '<li>Username is already taken</li><br>';
      if ($focusId == '') $focusId = '#userName';
	}

    if ($password1 == '') {
      $errors .= '<li>Password is required</li><br>';
      if ($focusId == '') $focusId = '#password1';
    }
    if (strlen($password1) < 9) {
      $errors .= '<li>Password must be at least 9 characters long</li><br>';
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
    <?php }
  }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resources/css/master.css">
    <title>Create Account</title>
  </head>
  <body>
    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li class="right"><a href="#">SIGN UP</a></li>
        <li class="right"><a href="supplier_login.php">LOGIN ROOT BREWERS</a></li>
        <li class="right"><a href="consumer_login.php">LOGIN CONSUMERS</a></li>
        <li><a href="about.php">ABOUT</a></li>
      </ul>
    </div>

      <form class="form_reg" id="form" target="form-iframe"  method="post" action="create_account.php" style="font-size: 13px; font-family: Verdana; width: 650px;">
			<fieldset>
				<section class="formData">
					<h2 class="centerMe" >Register with CraftLink Today!</h2>

			      <label class="field" for="userName">Username:</label>
			      <div class="value"><input type="text" size="60" value="<?php echo $userName; ?>" name="userName" id="userName"/></div>

			      <label class="field" for="password1">Password:</label>
			      <div class="value"><input type="password" size="60" value="<?php echo $password1; ?>" name="password1" id="password1"/></div>

			      <label class="field" for="password2">Confirm Password:</label>
			      <div class="value"><input type="password" size="60" value="<?php echo $password2; ?>" name="password2" id="password2"/></div>

			      <label class="field" for="email">Email:</label>
			      <div class="value"><input type="text" size="60" value="<?php echo $email; ?>" name="email" id="email"/></div>

			      <label class="field" for="phoneNum">Phone (XXX-XXX-XXXX):</label>
			      <div class="value"><input type="text" size="60" value="<?php echo $phoneNum; ?>" name="phoneNum" id="phoneNum"/></div>

			      <input type="radio" class="radio" id="supplier" name="userType" value="supplier"  /> Supplier<br/>
	  			   <input type="radio" class="radio" id="consumer" name="userType" value="consumer" checked/> Consumer<br/>

			      <label class="field terms_label" for="acceptInput">Terms and Conditions:</label>
			      <div class="value"><input type="checkbox" id="acceptterms" name="terms" value="acceptterms" /> I accept the terms</div>



			      <input type="submit" value="Create Account" id="save" name="save"/>
				</section>
		  </fieldset>
		</form>

<?php
	if($havePost && $errors == '') {
		// hashing the password first
		$password1 = hash("sha256", $password1);
		$createTime = time() + (7 * 24 * 60 * 60);
		$query = "INSERT INTO `user` (`username`, `email`, `passwordhash`, `create_time`, `user_id`, `phonenumber`,`issupplier`) VALUES ('$userName', '$email', '$password1', now(), NULL, '$phoneNum',$userTypeCode)";
		$result0 = $conn->query($query);
		if (!$result0) {
	    		trigger_error('Invalid query: ' . $conn->error);
			}

	  if ($conn->connect_error) {
		  echo '<pre class="messages">Error: ';
		  echo $conn->connect_errno . ' - ' . $db->connect_error . '</pre>';
	  }
	  	header("Location: index.php");
	}

?>
  </body>
</html>
