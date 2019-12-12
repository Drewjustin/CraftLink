<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="resources/css/master.css">
    <title>CraftLink.rootbeer</title>
  </head>
<?php
 //NOT HTTP POST
 function executePost(&$con,&$sql) { //helper method for SQL queries WITHOUT result
   if (mysqli_query($con,$sql)) {
    //  echo "Success";
   } else {
    //  echo "Error" . mysqli_error($con);
   }
  //  echo("<br>");
 }
 //NOT HTTP GET
 function executeGet(&$con,&$sql,&$result) { //helper method for SQL queries WITH result
   $result = mysqli_query($con,$sql);
   if ($result) {
    //  echo "Success";
   } else {
    //  echo "Error" . mysqli_error($con);
   }
  //  echo("<br>");
 }


$servername = "149.28.55.25";
$username = "websysroot";
$password = "craftlink.rootbeer";
$dbname = "CraftLink";

// check if a login has occured, if so the $session[logon] array will exist
// if it does then check the value, if it is true, the user is logged in, otherwise they are not
session_start();
$navLogout = true;
if(array_key_exists("logon", $_SESSION)){
   if($_SESSION["logon"]){
      $navLogout = false;
   }
}
else{
   $navLogout = true;
}

// check if logout keyword is in the search bar
if(isset($_GET['logout'])){      // check that logout is in URL
   $_SESSION = array();          //clears array
   session_destroy();
   $navLogout = true;
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Grab everything from the craflink table
$sql = "SELECT * FROM CraftLink.product";




//$result = $conn->query($sql);


 ?>

<body class="landing_page">
  <div class="landing_img">
    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>

      <?php
         if($navLogout){
            // check to see if the user is logged in, if not, show signup links
      ?>
         <ul>
           <li><a class="active" href="index.php">HOME</a></li>
           <li class="right"><a href="create_account.php">SIGN UP</a></li>
           <li class="right"><a href="supplier_login.php">LOGIN ROOT BREWERS</a></li>
           <li class="right"><a href="consumer_login.php">LOGIN CONSUMERS</a></li>
           <li><a href="#">ABOUT</a></li>
         </ul>
      <?php
         } else{
            // otherwise, show the logout link
      ?>
         <ul>
           <li><a class="active" href="index.php?consumer_home">HOME</a></li>
           <li class="right"><a href="index.php?logout">LOGOUT</a></li>
           <li><a href="#">ABOUT</a></li>
         </ul>
      <?php } ?>
    </div>

    <div class="about">
      <img src="resources/logoText.png" class="logo"/>

    <div class="about_section">
      <h1>NO HASSLE WHOLESALE ORDERING</h1>
      <p>CraftLink saves beverage managers valuable time. No more calling and emailing independent breweries every week. Through an easy to use e-commerce website, retailers browse products and schedule deliveries. CraftLink's automatic invoicing system allows retailers to pay independent producers directly over the web or through traditional terms via email.</p>
    </div>
    <div class="about_section about_middle">
      <h1>RETAILERS: HOW IT WORKS</h1>
      <ol>
        <li>Sign up for an account</li><br/>

        <li>Browse live inventories of New York breweries</li><br/>

        <li>Pay instantly online or through invoice</li><br/>

        <li>Schedule delivery</li><br/>
      </ol>
    </div>
    <div class="about_section">
      <h1>RETAILERS: HOW IT WORKS</h1>
      <p>We set out to create a better way for retailers to purchase craft products from the best self-distributed producers in New York.</p>
    </div>




    </div>
  </div>
</body>
</html>
