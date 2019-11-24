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

$sql = "SELECT product_id, product_name, product_dscpt, product_unit product_inStock FROM craftlink";
$result = $conn->query($sql);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if (isset($_POST["Add"]) && $_POST['Add'] =='Add'){

   }
}

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
            <article id="add_product">
               <form class="" action="submit" method="post">
                  <input type="text" name="name" value="Name">
                  <input type="text" name="description" value="Description">
                  <input type="int" name="price" value="Price">
                  <input type="text" name="unit_sold" value="Unit Sold">
                  <input type="int" name="in_stock" value="In stock">
                  <input type="submit" name="Add" value="Add Product">
               </form>

            </article>
          <?php
          $conn->close();
           ?>
       </section>

    </body>
 </html>
