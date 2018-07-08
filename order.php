<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByProduct_ID = $db_handle->runQuery("SELECT * FROM inventory WHERE Product_ID='" . $_GET["Product_ID"] . "'");
			$itemArray = array($productByProduct_ID[0]["Product_ID"]=>array('Name'=>$productByProduct_ID[0]["Name"], 'Product_ID'=>$productByProduct_ID[0]["Product_ID"], 'quantity'=>$_POST["quantity"], 'Price'=>$productByProduct_ID[0]["Price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByProduct_ID[0]["Product_ID"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByProduct_ID[0]["Product_ID"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["Product_ID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NUST CAFE's</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
	<body style="background-image: url('nowbg.jpg')">



    <nav style="background-color: #029DAB" class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
          <a class="navbar-logo" style="margin:10px; margin-right: 50px;" href="#">
            <!-- div -->
            <img src="img/logo.png" style="max-height: 50px !important; width: auto; margin-right: 2%; margin-bottom: 1%;">
            <span style="color: #fff; ">
                Hookah Pani
            </span>
          </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-left">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="wall.php">The Wall</a>
            </li>
            <li><a href="jango.php">Jango</a>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c1.php">Concordia 1<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.php">Stationary Shop</a></li>
                <li><a href="c1-mart.php">Mart</a></li>
                <li><a href="c1-cafe.php">Cafetaria</a></li>
              </ul>
            </li>
            <!-- <a  href="#cafe">Main Cafe</a> -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="c2.php">Boys' Cafe<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="c1-stationary.php">Stationary Shop</a></li>
                <li><a href="c1-mart.php">Mart</a></li>
                <li><a href="c1-cafe.php">Cafetaria</a></li>
              </ul>
            </li>
            <li><a href="about.php">About</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a data-toggle="modal" data-target="#myModal" id="log"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
          </ul> 
        </div>
      </div>
    </nav>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="order.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Name</strong></th>
<th style="text-align:left;"><strong>Product_ID</strong></th>
<th style="text-align:right;"><strong>Quantity</strong></th>
<th style="text-align:right;"><strong>Price</strong></th>
<th style="text-align:center;"><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["Name"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["Product_ID"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "Rs".$item["Price"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="order.php?action=remove&Product_ID=<?php echo $item["Product_ID"]; ?>" class="btnRemoveAction">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["Price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "Rs".$item_total; ?></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM inventory ORDER BY Product_ID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
	<div class="container">
		<div class="product-item">
			<form method="post" action="order.php?action=add&Product_ID=<?php echo $product_array[$key]["Product_ID"]; ?>">
			<div class="product-image"><img src="beef.jpg"></div>
			<div><strong><?php echo $product_array[$key]["Name"]; ?></strong></div>
			<div class="product-price"><?php echo "Rs".$product_array[$key]["Price"]; ?></div>
			<div><input type="text" Name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
</div>
	<?php
			}
	}
	?>
</div>
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <ul class="clearfix">
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">About</a>
                        </li>
                        <li><a href="#">Contact Us</a>
                        </li>
                        <li><a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2017, All Rights Reserved</p>
                </div>
            </div>

        </div>

    </footer>
</BODY>
</HTML>