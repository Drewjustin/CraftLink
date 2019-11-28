<?php
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

//Grab everything from the craflink table
$sql = "SELECT * FROM CraftLink.product";


// ADD PRODUCT BUTTON
$resultAddP = NULL;
if(isset($_POST['addProduct'])){
   $addProduct = $_POST['addProduct'];
   if($addProduct == "Submit"){
      $p_id = $_POST['p_id'];
      $s_id = $_POST['s_id'];
      $name = $_POST['name'];
      $dscpt = $_POST['description'];
      $price = $_POST['price'];
      $unit = $_POST['unit_sold'];
      // echo $name . '<br>';
      // echo $dscpt . '<br>';
      // echo $price . '<br>';
      // echo $unit . '<br>';
      $sqlAddP = 'INSERT INTO CraftLink.product (`product_id`, `supplier_id`, `product_name`, `product_dscpt`, `product_price`,`product_unitInWhichSold`)
      VALUES (\''
      . $p_id . '\',\''
      . $s_id . '\',\''
      . $name . '\',\''
      . $dscpt . '\',\''
      . $price . '\',\''
      . $unit . '\')';
      //$resultAddP = $conn->query($sqlAddP);
      executePost($conn, $sqlAddP, $resultAddP);
   }
}
//$result = $conn->query($sql);
executeGet($conn, $sql, $result);

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

  <body class="landing_page">
    <!-- NAVBAR -->
    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="#">HOME</a></li>
        <li class="right"><a href="create_account.php">SIGN UP</a></li>
        <li class="right"><a href="supplier_login.php">Login Root Brewers</a></li>
        <li class="right"><a href="consumer_login.php">Login Customers</a></li>
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div>
    <div class="logo">
      <img class="logo" src="resources/logoCrop.jpg" alt="Craftlink Logo">
    </div>
    <div id='searchbar'>
        <script type="text/javascript">
            $(document).ready(function () {
              

                var drinks = new Array("Root Beer", "Rooty Roots", "Birch Beer", "Ginger Beer");
                $("#input").jqxInput({placeHolder: "Search Product", height: 30, width: 250, minLength: 1, dropDownWidth: 150, source: drinks });

            });
        </script>
       <input type="text" id="input"/>
    </div>
  </body>
</html>
