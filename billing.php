<?php
	//$formData = array(
		// "firstname" => $_POST["firstName"],
		// "middlename" => $_POST["middleInitial"],
		// "lastname" => $_POST["lastName"],
  //       "billingAddress" => $_POST["billingAddress"],
  //       "billingAddressLine2" => $_POST["billingAddressLine2"],
  //       "billingCity" => $_POST["billingCity"],
  //       "billingState" => $_POST["billingState"],
  //       "billingZipCode" => $_POST["billingZipCode"],
  //       "billingCountry" => $_POST["billingCountries"],
  //       "shippingAddressCheckBox" => $_POST["shippingAddressCheckBox"],
  //       "shippingAddress" => $_POST["shippingAddress"],
  //       "shippingAddressLine2" => $_POST["shippingAddressLine2"],
  //       "shippingCity" => $_POST["shippingCity"],
  //       "shippingState" => $_POST["shippingState"],
  //       "shippingZipCode" => $_POST["shippingZipCode"],
  //       "shippingCountry" => $_POST["shippingCountries"]//,
        // "cardNumber" => $_POST["cardNumber"],
        // "expirationDate" => $_POST["expirationDate"],
        // "expirationYear" => $_POST["expirationYear"],
        // "securityCode" => $_POST["securityCode"],
        // "cardType" => $_POST["cardType"]
 //);
	
  // $response = "<table>";
  // $response .= "<tr><th>Customer Details</th></tr>";
  // $response .= "<tr><td>" . $formData['firstname'] . "</td><td>" .  $formData['middlename'] . "</td><td>" . $formData['lastname'] . "</td></tr>";
  // $response .= "<tr><td>Billing Address</td></tr>";
  // $response .= "<tr><td>" . $formData['billingAddress'] . "</td></tr>";
  // $response .= "<tr><td>" . $formData['billingAddressLine2'] . "</td></tr>";
  // $response .= "<tr><td>" . $formData['billingCity'] . "</td><td>" . $formData['billingState'] . "</td></tr>";
  // $response .= "<tr><td>" . $formData['billingZipCode'] . "</td><td>" . $formData['billingCountry'] . "</td></tr>";
  
  // if (isset($_POST["shippingAddressCheckBox"]) && $_POST["shippingAddressCheckBox"] == 'true')
  // {
  //   $response .= "<tr><td>Shipping Address</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingAddress'] . "</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingAddressLine2'] . "</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingCity'] . "</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingState'] . "</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingCity'] . "</td><td>" . $formData['shippingState'] . "</td></tr>";
  //   $response .= "<tr><td>" . $formData['shippingZipCode'] . "</td><td>" . $formData['shippingCountry'] . "</td></tr>"; 
  //  }
    // $response .= "<tr><td>Billing Information</td></tr>";
    // $response .= "<tr><td>" . $formData['cardType'] . "</td></tr>";
    // $response .= "<tr><td>" . $formData['cardNumber'] . "</td></tr>";
    // $response .= "<tr><td>" . $formData['expirationDate'] . "</td><td>" . $formData['expirationYear'] . "</td></tr>";
    // $response .= "<tr><td>" . $formData['securityCode'] . "</td></tr>";


//   echo $response;

    $servername = "149.28.55.25";
    $username = "websysroot";
    $password = "craftlink.rootbeer";
    $dbname = "CraftLink";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
         //echo "connection failed";
    } else {
        //echo "connection successful";
    }


    $product_id = '';
    $name = '';
    $price = '';
    $supplier = '';
    $units = '';
    $instock = '';

    $submitted = isset($_GET['buy']);

    if($submitted && isset($_GET['item'])){
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
<!--     <link rel="stylesheet" href="jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxexpander.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxvalidator.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxbuttons.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcheckbox.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/globalization/globalize.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcalendar.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxdatetimeinput.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxmaskedinput.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxlistbox.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxcombobox.js"></script> 
    <script type="text/javascript" src="jqwidgets/jqwidgets/jqxscrollbar.js"></script> 
    <script type="text/javascript" src="jqwidgets/scripts/demos.js"></script>      -->  <!-- commented out Angular components -->

    <title>Checkout</title>

  </head>
  
  <body>

      
    <!--img src=LOGO -->
    <div class="nav">
      <a href="index.php">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li class="right"><a href="index.php">Logout</a></li>
        <li><a href="#">About</a></li>
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
<div style="font-size: 8px;"> <p>Debug output from mail-sending</p>
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

        // $to      = 'martinpaulsen7@gmail.com';
        // $subject = 'the subject';
        // $message = 'hello';
        // $headers = 'From: martinpaulsen7@gmail.com' . "\r\n" .
        //     'Reply-To: martinpaulsen7@gmail.com' . "\r\n" .
        //     'X-Mailer: PHP/' . phpversion();

        // mail($to, $subject, $message, $headers);

    } else {
        echo '<h1 style="font-size:16px;">test</h1>';
    }

?>
  </div>  
  </body>
</html>


