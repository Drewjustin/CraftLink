<?php
session_start();
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
$sql = "SELECT * FROM CraftLink.product";


// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    if (isset($_POST["Submit"]) && $_POST['Submit'] =='Submit'){
//       // var_dump($_POST);
//       $sql2 = 'INSERT INTO CraftLink.product (`product_name`, `product_dscpt`,
//       `product_price`, `product_unitinWhichSold`) VALUES' . '('. $_POST['name'] . ',' . $_POST['description']
//       . $_POST['price'] . ',' . $_POST['unit_sold'] . ')';
//       $result2 = $conn->query($sql2);
//    }
// }

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
         <li><a href="#">ABOUT</a></li>
         </ul>
      </div>
       <section class="main">
          <h2 class="centerMe">Brewer Home</h1>

          <section class="product_table">
             <?php
             if (!empty($result) && $result->num_rows > 0) {
                 echo "<table>
                 <tr>
                 <th width='5%'>Supplier ID</th>
                 <th width='5%'>Product ID</th>
                 <th width='15%'>Name</th>
                 <th width='50%'>Description</th>
                 <th width='10%'>Price</th>
                 <th width='10%'>Unit Sold</th>
                 <th width='5%'>In Stock</th>";
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                     echo "<tr>"
                     . "<td>" . $row["supplier_id"] . "</td>"
                     . "<td>" . $row["product_id"] . "</td>"
                     . "<td>" . $row["product_name"] . "</td>"
                     . "<td>" . $row["product_dscpt"] . "</td>"
                     . "<td>" . $row["product_price"] . "</td>"
                     . "<td>" . $row["product_unitInWhichSold"] . "</td>"
                     . "<td>" . $row["product_inStock"] . "</td>"
                     // . "<a href='edit.php?'>edit</a>;"
                     . "</tr>";
                 }
                 echo "</table>";
             } else {
                 echo "0 results";
             }
             ?>
          </section>
            <article id="add_products">
               <button type="button" id="add_product_button">Add Product</button>
               <form id="add_product" action="supplier.php" method="post">
                  Product ID:<input type="text" name="p_id" value="">
                  Supplier ID:<input type="text" name="s_id" value="">
                  Name:<input type="text" name="name" value="">
                  Description:<input type="text" name="description" value="">
                  Price:<input type="int"  name="price" value="">
                  Unit Sold:<input type="text" name="unit_sold" value="">
                  <input type="submit" name="addProduct" value="Submit">
               </form>
            </article>
          <?php
          $conn->close();
           ?>
       </section>

    </body>
 </html>
