<?php
session_start();
  function executePost(&$con,&$sql) {
   if (mysqli_query($con,$sql)) {
   //   echo "Success";
   } else {
   //   echo "Error" . mysqli_error($con);
   }
   echo("<br>");
 }
 function executeGet(&$con,&$sql,&$result) {
   $result = mysqli_query($con,$sql);
   if ($result) {
   //   echo "Success";
   } else {
   //   echo "Error" . mysqli_error($con);
   }
   // echo("<br>");
 }


$servername = "149.28.55.25";
$username = "websysroot";
$password = "craftlink.rootbeer";
$dbname = "CraftLink";

// check if session is active, if not, user is not logged in and is redirected home
if(!$_SESSION['logon']){
   header("Location: index.php");
   die();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Grab everything from the craflink table
// $sql = "SELECT * FROM CraftLink.product";
$sql = 'SELECT * FROM CraftLink.product WHERE supplier_id = \'' . $_SESSION['userid'] . '\'';

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    if (isset($_POST["Submit"]) && $_POST['Submit'] =='Submit'){
//       // var_dump($_POST);
//       $sql2 = 'INSERT INTO CraftLink.product (`product_name`, `product_dscpt`,
//       `product_price`, `product_unitinWhichSold`) VALUES' . '('. $_POST['name'] . ',' . $_POST['description']
//       . $_POST['price'] . ',' . $_POST['unit_sold'] . ')';
//       $result2 = $conn->query($sql2);
//    }
// }\

$uid = $_SESSION['userid'];

  $submitName = isset($_POST['new_name']);


   if($submitName){
      $newName = $_POST['new_name'];
      $queryResetName = "UPDATE `user` SET `businessname` = '$newName' WHERE `user_id` = '$uid'";
      $resultResetName = $conn->query($queryResetName);
      if(!$resultResetName){
         trigger_error('Invalid query: ' . $conn->error);
      }
   }

$companyName = '';

$queryGetCompany = "SELECT `businessname` FROM `user` WHERE `user_id` = '$uid'";
$resultGetCompany = $conn->query($queryGetCompany);
if(!$resultGetCompany){
   trigger_error('Invalid query: ' . $conn->error);
} else {
   $company = $resultGetCompany->fetch_assoc();
   $companyName = $company['businessname'];
}

// ADD PRODUCT BUTTON
$resultAddP = NULL;
if(isset($_POST['addProduct'])){
   $addProduct = $_POST['addProduct'];
   if($addProduct == "Submit"){
      // $p_id = $_POST['p_id'];
      $s_id = $_SESSION['userid'];
      $name = $_POST['name'];
      $dscpt = $_POST['description'];
      $price_dollars = $_POST['price_dollars'];
      $price_cents = $_POST['price_cents'];
      $price = strval(intval($price_dollars)*100 + intval($price_cents));
      $unit = $_POST['unit_sold'];
      // echo $name . '<br>';
      // echo $dscpt . '<br>';
      // echo $price . '<br>';
      // echo $unit . '<br>';
      $sqlAddP = 'INSERT INTO CraftLink.product ( `supplier_id`, `product_name`, `product_dscpt`, `product_price`,`product_unitInWhichSold`)
      VALUES (\''
      // . $p_id . '\',\''
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

      <meta charset="utf-8">
      <link rel="stylesheet" href="resources/css/master.css">

      <link rel="stylesheet" href="jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
      <script type="text/javascript" src="jqwidgets/scripts/jquery-1.12.4.min.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcore.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxdata.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxbuttons.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxscrollbar.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxmenu.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcheckbox.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxlistbox.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxdropdownlist.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxgrid.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxgrid.sort.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxgrid.pager.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxgrid.selection.js"></script>
      <script type="text/javascript" src="jqwidgets/jqwidgets/jqxgrid.edit.js"></script>
      <script type="text/javascript" src="jqwidgets/scripts/demos.js"></script>       <!-- commented out Angular components -->
      <script type="text/javascript">
         $(document).ready(function () {
            $("#add_product").hide();

            $("#add_product_button").click(function () {
               $("#add_product").toggle();
            });

         });
      </script>
      <!--script type="text/php" src="supplier.php"></script-->
      <!-- DEMO EXAMPLE -->   <link href="jqwidgets/demos/Javascript & JQuery/jqxgrid/defaultfunctionality.htm" type="text/html" />
      <title>Supplier Homepage</title>
    </head>
    <body>

      <div class="nav">
         <a href="index.php?logout">   <!-- if supplier tries to go to landing page they will be logged out (security purposes)-->
         <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
         </a>
         <ul>
         <li><a class="active" href="#">HOME</a></li>
         <!-- LOGOUT TAKES YOU BACK TO INDEX LANDING PAGE -->
         <li class="right"> <a href="index.php?logout">LOG OUT</a></li>
         <li><a href="about.php">ABOUT</a></li>
         </ul>
      </div>
      <section class="main">
         <!-- <h2 class="centerMe">Brewer Home</h1> -->

         <h2 class="centerMe"><?php echo $companyName ?> Home</h2>

         <div id="add_company_name">
            <form id="searchbarcenter" class="form" action="supplier.php" method="post">
               <label>Set your company name here:</label><br>
               <input type="text" id="username" name="new_name" placeholder="Company Name"/>
               <input type="submit" id="search_button" name="set_name" value="Submit"/>
            </form>
         </div>

         <section class="product_table">
            <?php
            if (!empty($result) && $result->num_rows > 0) {
               $stock_status = "";
               //<th width='5%'>Supplier ID</th>
               echo "<table>
               <tr>
               <th width='5%'>Product ID</th>
               <th width='15%'>Name</th>
               <th width='40%'>Description</th>
               <th width='15%'>Price Per Unit</th>
               <th width='15%'>Volume Sold In</th>
               <th width='5%'>Change Stock Status</th>
               <th width='5%'>Delete</th>";
               // output data of each row
               while($row = $result->fetch_assoc()) {
                     if ($row["product_inStock"] == 0) {
                        $stock_status = "Out of Stock";
                     } else {
                        $stock_status = "In Stock";
                     }
                     echo "<tr>"
                     // . "<td>" . $row["supplier_id"] . "</td>"
                     . "<td>" . $row["product_id"] . "</td>"
                     . "<td>" . $row["product_name"] . "</td>"
                     . "<td>" . $row["product_dscpt"] . "</td>"
                     . "<td>" . $row["product_price"] . "</td>"
                     . "<td>" . $row["product_unitInWhichSold"] . "</td>"
                     //. "<td>" . $row["product_inStock"] . "</td>"
                     . "<td><a href='supplier.php?id=".$row["product_id"]."&status=".$row["product_inStock"]."'>"
                     . "<input type=\"submit\" name=\"stock\" value=\"" . $stock_status . "\"  >"
                     . "</a></td>"
                     . "<td><a href='supplier.php?id=".$row["product_id"]."&delete=1'>"
                     . "<input type=\"submit\" name=\"delete\" value=\"Delete\"  >"
                     . "</a></td>"
                     // . "<a href='edit.php?'>edit</a>;"
                     . "</tr>";
               }
               echo "</table>";
            } else {
               echo "0 results";
            }
            

            if (isset($_GET['id'])) {
               if (isset($_GET['status'])) {
                  if ($_GET['status'] == 0) {
                     $newstatus = 1;
                  } else {
                     $newstatus = 0;
                  }
                  if ($_GET['id'] != "") {
                     $sql = 'Update CraftLink.product SET `product_inStock` = '. $newstatus .' WHERE `product_id` = ' . $_GET['id'];
                     executePost($conn, $sql);
                     header('Location: supplier.php');
                  }
               }
               if (isset($_GET['delete'])) {
                  if ($_GET['delete'] == 1) {
                     if ($_GET['id'] != "") {
                        $sql = 'Delete from CraftLink.product where `product_id` = ' . $_GET['id'];
                        executePost($conn, $sql);
                        header('Location: supplier.php');
                     }
                  }
               }
            }



            ?>
          </section>
            <article id="add_products">
               <button type="button" id="add_product_button">Add Product</button>
               <form id="add_product" action="supplier.php" method="post">
                  <!-- <label for="p_id">Product ID:</label>
                  <input type="text" name="p_id" value=""> -->
                  <!-- <label for="s_id">Supplier ID:</label>
                  <input type="text" name="s_id" value=""> -->
                  <label for="name">Product Name:</label>
                  <input type="text" name="name" value="">
                  <label for="description">Description:</label>
                  <textarea name="description" rows="4" cols="25" maxlength="250"></textarea>
                  <!-- <input type="text" name="description" maxlength="500"value=""> -->
                  <label for="price">Price Per Unit:</label>
                  <span id="price_input">
                     <input type="int"  name="price_dollars" value="0" placeholder="$">
                     .
                     <input type="int"  name="price_cents" value="00" placeholder="¢">
                  </span>
                  <label for="unit_sold">Unit Sold:</label>
                  <input type="text" name="unit_sold" value="">
                  <input type="submit" name="addProduct" value="Submit">
               </form>
            </article>
          <?php
          $conn->close();
           ?>
       </section>

    </body>
 </html>
