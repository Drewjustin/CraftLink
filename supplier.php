<?php

$servername = "149.28.55.25";
$username = "websysroot";
$password = "craftlink.rootbeer";
$dbname = "craftlink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT product_id, product_name, product_dscpt, product_unit product_inStock FROM craftlink";
$result = $conn->query($sql);


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
    <head>
       <meta charset="utf-8">
       <title>Brewer Home</title>
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
          <form id="add_product" action="supplier.php" method="post">
             <input id="add" type="submit" name="Add" value="Add">
          </form>
          <?php
          $conn->close();
           ?>
       </section>

    </body>
 </html>
