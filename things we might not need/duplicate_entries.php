<?php
// I MOVED CREATE_ACCOUNT PHP THAT WAS COMMENTED OUT HERE TO DECREASE CLUTTER OF PAGE
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

// TESTING BY PRINTING ALL USERS
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
