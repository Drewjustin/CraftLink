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

/*
// DELETE DUPLICATE TABLE ENTRIES

// create query
$queryAddUsers = 'INSERT INTO `user` (`username`, `email`, `passwordhash`, `create_time`, `user_id`, `phonenumber`) VALUES ';
$uniqueUsers = array(); // list of unique usernames
$usersAdded = 0;

// find all users that can't be deleted due to foreign key constraints in product table
$queryFindDependencies = "SELECT * FROM `user` LEFT JOIN `product` ON `user`.`user_id` = `product`.`supplier_id` WHERE `product`.`supplier_id` IS NOT NULL";
$resultFindDependencies = $conn->query($queryFindDependencies);
if(!$resultFindDependencies) { // print if there are issues
	trigger_error('Invalid query: ' . $conn->error);
}
// loop through users
$num_users = $resultFindDependencies->num_rows;
for($i = 0;  $i < $num_users; $i++){
	$userExists = false;

	// get user info
	$currentUser = $resultFindDependencies->fetch_assoc();
	$currentUsername = $currentUser['username'];

	// check if username matches any of the previous unique usernames
	for($j = 0; $j < count($uniqueUsers); $j++){
		if($uniqueUsers[$j] == $currentUsername) {
			$userExists = true;
		}
	}

	// of it doesn't, add it to the query and the list of unique usernames
	if($userExists == false){
		$uniqueUsers[] = $currentUsername;
	}
}


// get info for all users currently in the table
$queryFindUsers = "SELECT * FROM `user`";
$resultFindUsers = $conn->query($queryFindUsers);
if(!$resultFindUsers) { // print if there are issues
	trigger_error('Invalid query: ' . $conn->error);
}
// loop through all users
$num_users = $resultFindUsers->num_rows;
for($i = 0;  $i < $num_users; $i++){
	$userExists = false;

	// get user info
	$currentUser = $resultFindUsers->fetch_assoc();
	$currentUsername = $currentUser['username'];
		$c_email = $currentUser['email'];
		$c_pass = $currentUser['passwordhash'];
		$c_phone = $currentUser['phonenumber'];
		$c_time = $currentUser['create_time'];

	// check if username matches any of the previous unique usernames
	for($j = 0; $j < count($uniqueUsers); $j++){
		if($uniqueUsers[$j] == $currentUsername) {
			$userExists = true;
		}
	}

	// of it doesn't, add it to the query and the list of unique usernames
	if($userExists == false){
		$queryAddUsers .= "('$currentUsername', '$c_email', '$c_pass', '$c_time', NULL, '$c_phone'), ";
		$uniqueUsers[] = $currentUsername;
		$usersAdded++;
	}
}
$queryAddUsers = substr($queryAddUsers, 0, -2);
$queryAddUsers .= ';';

// clear the table
$queryClearTable = "DELETE `user` FROM `user` LEFT JOIN `product` ON `user`.`user_id` = `product`.`supplier_id` WHERE `product`.`supplier_id` IS NULL";
$resultClearTable = $conn->query($queryClearTable);
if(!$resultClearTable){
	trigger_error('Invalid query: ' . $conn->error);
}

// add all the users to the table
if($usersAdded > 0){
	$resultAddUsers = $conn->query($queryAddUsers);
	if(!$resultAddUsers){ // print if there is an error
		trigger_error('Invalid query: ' . $conn->error);
		echo $queryAddUsers;
	}
}


// print all users in table for error checking
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
*/
?>

<?php
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
    // get and clean form entries
    $userName = htmlspecialchars(trim($_POST["userName"]));
    $password1 = htmlspecialchars(trim($_POST["password1"]));
    $password2 = htmlspecialchars(trim($_POST["password2"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phoneNum = htmlspecialchars(trim($_POST["phoneNum"]));
	$userType = htmlspecialchars(trim($_POST["userType"])); // "supplier" or "consumer"
	$userTypeCode = ($userType=="supplier")?1:0; 
    if(isset($_POST["terms"])) $acceptterms = htmlspecialchars(trim($_POST["terms"]));
    //echo $acceptterms;


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
    $checkUsername = "SELECT * FROM `user` WHERE `username` = '" . $userName ."';";
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
  	<pre id="errors"></pre>

    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li class="right"><a href="#">SIGN UP</a></li>
        <li class="right"><a href="supplier_login.php">LOGIN ROOT BREWERS</a></li>
        <li class="right"><a href="consumer_login.php">LOGIN CONSUMERS</a></li>
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div>

    <h2 class="centerMe" >Register with CraftLink Today!</h2>
    <div class="">
      <form class="form_reg" id="form" target="form-iframe"  method="post" action="create_account.php" style="font-size: 13px; font-family: Verdana; width: 650px;">
           <fieldset>
		    <div class="formData">

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
		    </div>
		  </fieldset>

			</form>
    </div>





    <div id="bodyBlock">



<?php
	if($havePost && $errors == '') {
	// TODO: hash the password first
	$createTime = time() + (7 * 24 * 60 * 60);
	$query = "INSERT INTO `user` (`username`, `email`, `passwordhash`, `create_time`, `user_id`, `phonenumber`,`issupplier`) VALUES ('$userName', '$email', '$password1', now(), NULL, '$phoneNum',$userTypeCode)";
	$result0 = $conn->query($query);
	if (!$result0) {
    		trigger_error('Invalid query: ' . $conn->error);
		}

  if ($conn->connect_error) {
    echo '<div class="messages">Error: ';
    echo $conn->connect_errno . ' - ' . $db->connect_error . '</div>';
	}
}

/*
// PRINT ALL USERS for error checking

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
*/

?>





    </div>


  </body>
</html>
