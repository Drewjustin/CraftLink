<?php
	
	session_start();
	if(!$_SESSION['logon']){
	   header("Location: index.php");
	   die();
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
    } else {
    }


    $product_id = '';
    $name = '';
    $price = '';
    $supplier = '';
    $units = '';
    $instock = '';


    if(isset($_GET['item'])){
        $product_id = $_GET['item'];
        $findItemQuery = "SELECT * FROM `product` WHERE `product_id` = " . $product_id;
        $findItemResult = $conn->query($findItemQuery);
        if(!$findItemResult){
            trigger_error('Invalid query: ' . $conn->error);
        } else {
            $item = $findItemResult->fetch_assoc();
            $name = $item['product_name'];
            $price = $item['product_price'];
            $supplier = $item['supplier_id'];
            $units = $item['product_unitInWhichSold'];
            $instock = $item['product_inStock'];
        }
    }

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resources/css/master.css">
    <script type="text/javascript" src="jqwidgets/scripts/jquery-1.11.1.min.js"></script>

    <title>Checkout</title>

  </head>

  <body>


    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">HOME</a></li>
        <li class="right"><a href="index.php">LOGOUT</a></li>
        <li><a href="about.php">ABOUT</a></li>
      </ul>
    </div>

    <div class="" >
        <h2>Checkout <?php echo "$name"; ?></h2>
        <?php
            if($instock == 0){
                echo 'This item is out of stock<br><br>';
                echo '<script type="text/javascript">$(document).ready(function(){$("#purchase_form").css({"display":"none"});});</script>';
            }
        ?>
        <form class="formData" id="purchase_form"  method="post" style="width: 650px;">


            <label>How many <?php echo "$name"; ?> to buy?</label><br>
            <input type="number" name="quantity" min="1" max="10"/><br>
            <input type="submit" name="sendEmail" value="Checkout"/>
        </form>

    </div>

    <br/>

<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
    $purchased = isset($_POST['sendEmail']);

    if($purchased){
        try{
            include("phpmailer/PHPMailer.php");
            include("phpmailer/Exception.php");
            include("phpmailer/SMTP.php");
            $mail = new PHPMailer();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth=true;
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('craftlinktesting@gmail.com', 'CraftLink Server');
            // $mail->CharSet = 'UTF-8';
            $mail->Username ='craftlinktesting';
            $mail->Password = 'Cr@ftlink1';

            $mail->addAddress('craftlinktesting@gmail.com','CraftLinkConsumer');
            $mail->addAddress('martinpaulsen7@gmail.com','CraftLinkSupplier');

            $mail->isHTML(false);
            $mail->Subject = 'The intention of purchasing rootbeer';
            $mail->Body = "Test message sent from PHPMailer";

            $status = $mail->send();


            if($status) {
             echo '<h2>Email sent to consumer and supplier.</h2>';
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

?>
  </div>
  </body>
</html>
