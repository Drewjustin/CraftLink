<?php

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

$sql = 'SELECT `product_id`, `product_name`, `product_dscpt`, `product_unitinWhichSold` `product_inStock` FROM CraftLink';
$result = $conn->query($sql);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if (isset($_POST["Submit"]) && $_POST['Submit'] =='Submit'){
      // var_dump($_POST);
      $sql2 = "INSERT INTO `CraftLink` (`product_name`, `product_dscpt`,
      `product_price`, `product_unitinWhichSold`) VALUES" . "(". $_POST['name'] . "," . $_POST['description']
      . $_POST['price'] . "," . $_POST['unit_sold'] . ")";
      $result2 = $conn->query($sql2);
   }
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
    <head>
       <meta charset="utf-8">
       <title>Brewer Home</title>
       <link rel="stylesheet" href="resources/css/master.css">
       <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>
       <script type="text/javascript" src="supplier.js"> </script>
    </head>
    <body>
       <section class="main">
          <h1>Brewer Home</h1>

          <section id="product_table">
             <?php
             if ($result->num_rows > 0) {
                 echo "<table><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Unit Sold</th><th>In Stock</th>";
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                     echo "<tr><td>"
                     . $row["product_id"]
                     . "</td><td>"
                     . $row["product_name"]
                     . "</td><td>"
                     . $row["product_dscpt"]
                     . "</td><td>"
                     . $row["product_price"]
                     . "</td><td>"
                     . $row["product_unit"]
                     . "</td><td>"
                     . $row["product_inStock"]
                     . "</td><td>"
                     . "<a href='edit.php?'>edit</a>;"
                     . "</td><td></tr>";
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
                  Name:<input type="text" id='p_name' name="name" value="">
                  Description:<input type="text" id='p_dscpt' name="description" value="">
                  Price:<input type="int" id='p_price' name="price" value="">
                  Unit Sold:<input type="text" id='p_unit'name="unit_sold" value="">
                  <input type="submit" name="Submit" value="Submit">
               </form>
            </article>
          <?php
          $conn->close();
           ?>
       </section>

    </body>
 </html>
