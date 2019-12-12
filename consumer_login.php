<?php

  $servername = "149.28.55.25";
  $username = "websysroot";
  $password = "craftlink.rootbeer";
  $dbname = "CraftLink";

  $_SESSION['logon'] = false;             // logon is false until correct credentials are input
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  if (isset($_POST['username']) && isset($_POST['password']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $formData = array(
      "username" => $_POST["username"],
      "password" => $_POST["password"]
    );

    $user = $formData['username'];
    //create SQL statement and then call the query on the database checking for username and the matching password
    $sql = "SELECT * FROM `user` WHERE username = '$user'";
    $result = $conn->query($sql);
    //checking to see that everything exists before compairing values
    $fires = 0;
    if ($result){
      //storing the one match, if there are duplicates we have a bigger problem
      $entry = $result->fetch_assoc();

      //checking the username and password are a real user
      $fires = 1;
      // hashing password to check match
      $hash = hash("sha256", $formData['password']);
      if(!$entry['issupplier'] && strtolower($formData['username']) === strtolower($entry["username"]) && $hash === $entry["passwordhash"]) {
         echo "<p><h1>Login Successful</h1></p><p>We won't keep you logged in on this computer.</p>";
         //starting a session for the now logged in user
         session_start();
         $_SESSION['username'] = $formData['username'];
         $_SESSION['userid'] =$entry["user_id"];
         $_SESSION['logon'] = true;                      // now user is logged in
         header("Location: index.php?consumer_home");                 // redirect to supplier home when logged in
      }
      // in the event that they tried to log in with the wrong account type
      else if($entry['issupplier'] && strtolower($formData['username']) === strtolower($entry["username"]) && $hash === $entry["passwordhash"]) {
         echo "<p><h1>Login Not Successful</h1></p><p>You are a supplier! <a class='loginLink' href='supplier_login.php'>Login here</a></p>";
      }
      else{
         echo "<p><h1>Login Not Successful</h1></p><p>Invalid username or password.</p>";
      }

      //flag variable to create error for invalid usernames
      if ($fires === 0){
        echo "<p><h1>Login Not Successful</h1></p><p>Invalid username or password.</p>";
      }
    }
    //what is printed if the user does not enter a proper account
    else {
      echo "<p><h1>Login Not Successful</h1></p><p>Blank Field</p>.</p>";
    }
  }
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

    <title>Consumer Login</title>

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
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li class="right"><a href="create_account.php">SIGN UP</a></li>
        <li class="right"><a href="supplier_login.php">LOGIN ROOT BREWERS</a></li>
        <li class="right"><a href="#">LOGIN CONSUMERS</a></li>
        <li><a href="about.php">ABOUT</a></li>
      </ul>
    </div>

    <h2 class="centerMe">Consumer Login</h2>
    <div class="register-block" style="font-size: 13px; font-family: Verdana;">
      <form class="form" id="form" target="form-iframe" method="post" action="consumer_login.php" style="width: 650px;">

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
          </div>

      </form>
      <!--iframe id="form-iframe" name="form-iframe" class="demo-iframe" frameborder="0"></iframe-->
    </div>
  </body>
</html>
