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

// if logout link was clicked on the suppier.php page the session is destroyed
session_start();
$navLogout = true;               // assumes user is logged out upon entering page
if(isset($_GET['logout'])){      // check that logout is in URL
   $_SESSION = array();          //clears array
   session_destroy();
   $navLogout = true;
}
// if (session_status() == PHP_SESSION_ACTIVE) {  // when the user is logged in as a consumer url is specified
if(isset($_GET['userid'])){    
  $navLogout = false;
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

 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <!--<link rel="stylesheet" href="jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />-->
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxbuttons.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resources/css/master.css">
    <title>CraftLink.rootbeer</title>
  </head>

  <script type="text/javascript">
    $(document).ready(function () {
      var drinks = new Array("Root Beer", "Rooty Roots", "Birch Beer", "Ginger Beer");
      //$("#input").jqxInput({placeHolder: "Search Product", height: 30, width: 250, minLength: 1, dropDownWidth: 150, source: drinks });
    });
  </script>

  <body class="landing_page">
    <!-- NAVBAR -->
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
    <div class="logo">
      <img class="logo" src="resources/logoCrop.jpg" alt="Craftlink Logo">
    </div>
    <form id='searchbarcenter' method="get" action="index.php?consumer_home">
      <span id='searchbar'>
        <input type="text" id="input" name="search" value=""/>
        <input type="submit" name="searchbutton" value="Search">
      </span>
    </form>

    <?php
      // ADD PRODUCT BUTTON
      $result = NULL;
      if($_SERVER['REQUEST_METHOD'] == 'GET') {
        try {
          if (isset($_GET['searchbutton']) && $_GET['searchbutton'] == "Search") { //only process when search query string included
            echo "Searching for " . $_GET['search'] . ":<br>";
            if(isset($_GET['search']) ) {
              $namekeyword = $_GET['search']; //fixme pre-process (sanitize) the keyword
              $sql = 'SELECT * FROM CraftLink.product WHERE ( `product_name` LIKE \'%' . $namekeyword . '%\')';
              executeGet($conn, $sql, $result);
            }
          }
        }
        catch (Exception $e) {
          $err[] = $e->getMessage();
        }
        $err = Array();
        $_GET = NULL; //nullify request
      }
      //render the products, assumes $result contains some query result
      if (!empty($result) && $result->num_rows > 0) {
        echo "Results for " . $_GET['search'] . " is:<br>";
        echo "<table><tr><th>Name</th><th>Price</th><th>Description</th><th>Units Sold As</th></tr>";
        while ($row = $result->fetch_assoc()) { //iterate the next row and fill the table
          echo "<tr>"
          . "<td>". $row['product_name'] . "</td>"
          . "<td>". $row['product_price'] . "</td>"
          . "<td>". $row['product_dscpt'] . "</td>"
          . "<td>". $row['product_unitInWhichSold'] . "</td>"
          ."</tr>";
        }
        echo "</table>";
      } else {
        echo "No Results";
      }
      mysqli_close($conn);
    ?>
  </body>
</html>
