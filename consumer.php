<!DOCTYPE html>
<html lang="en">
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

    <script type="text/javascript" src="consumer.js"></script>
    <!--script type="text/php" src="supplier.php"></script-->
    <!-- DEMO EXAMPLE -->   <link href="jqwidgets/demos/Javascript & JQuery/jqxgrid/defaultfunctionality.htm" type="text/html" />
    <title>Consumer Homepage</title>


  </head>
  <body class="default">
    <!--img src=LOGO -->
    <div class="nav">
      <a href="index.html">
        <img class="nav-logo" src="resources/logoPic.png" alt="Craftlink Logo">
      </a>
      <ul>
        <li><a class="active" href="#">HOME</a></li>
        <!-- LOGOUT TAKES YOU BACK TO INDEX LANDING PAGE -->
        <li class="right"><a href="index.html">LOG OUT</a></li>
        <li class="right"><a href="billing.php">Checkout</a></li>
        <li><a href="#">ABOUT</a></li>
      </ul>
    </div>
    <!-- THIS IS ALL DUMMY DATA FOR PRESENTATION PURPOSES -->
    <h2 class="centerMe">Search Results</h2>
    <section class="results">
      <section class="result">
        <h2 id="product">Classic Root Beer</h2>
        <p id="brewer">Rooty Roots</p>
        <p id="description">This is your classic Root Beer, smooth and flavorful while bubbling on your tongue</p>
        <p id="price">$30.00</p>
        <input style="width: 20px; float:right;" type="number" name="quantity" value="0">
      </section>

      <div id="grid" style="width:50%; margin:auto;">
      </div>
    </section>


  </body>
</html>
