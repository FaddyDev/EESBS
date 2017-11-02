<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
 <?php include("includes/dbconn.php"); //DB
$tents = array(); $equips = array(); $caters = array(); $venues = array(); $seats = array();
try { 
 //Tents
  $sql = "SELECT * FROM tents JOIN s_providers on tents.uid = s_providers.uid WHERE s_providers.active=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $tents[] = $row;
	 }
	} 
	
	 //Equipment
  $sql = "SELECT * FROM equipment JOIN s_providers on equipment.uid = s_providers.uid WHERE s_providers.active=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $equips[] = $row;
	 }
	} 
	
	//Venues
  $sql = "SELECT * FROM venues JOIN s_providers on venues.uid = s_providers.uid WHERE s_providers.active=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $venues[] = $row;
	 }
	} 
	
	//Seats
  $sql = "SELECT * FROM seats JOIN s_providers on seats.uid = s_providers.uid WHERE s_providers.active=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $seats[] = $row;
	 }
	} 
	
	 //Catering
  $sql = "SELECT * FROM catering JOIN s_providers on catering.uid = s_providers.uid WHERE s_providers.active=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $caters[] = $row;
	 }
	} 
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>


 <?php
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$svstp = $_GET["svs"];
			$sql = '';
			$svs = array();
		if($svstp == 'tent'){
      //Tents
  $sql = "SELECT * FROM tents JOIN s_providers on tents.uid = s_providers.uid WHERE tents.code='" . $_GET["code"] . "'";
		}	
	else if($svstp == 'seats'){
      //Seats
  $sql = "SELECT * FROM seats JOIN s_providers on seats.uid = s_providers.uid WHERE seats.code='" . $_GET["code"] . "'";
		}	
		else if($svstp == 'equips'){
      //equipment
  $sql = "SELECT * FROM equipment JOIN s_providers on equipment.uid = s_providers.uid WHERE equipment.code='" . $_GET["code"] . "'";
		}	
		else if($svstp == 'caters'){
      //Catering
  $sql = "SELECT * FROM catering JOIN s_providers on catering.uid = s_providers.uid WHERE catering.code='" . $_GET["code"] . "'";
		}	
		else if($svstp == 'venues'){
      //Venues
  $sql = "SELECT * FROM venues JOIN s_providers on venues.uid = s_providers.uid WHERE venues.code='" . $_GET["code"] . "'";
		}	
   
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $svs[] = $row;
	 }
	}
	$serviceArray = array();
				if($svstp == 'tent'){
      //Tents
 $serviceArray = array($svs[0]["code"]=>array('companyName'=>$svs[0]["companyName"], 'location'=>$svs[0]["c_location"], 'code'=>$svs[0]["code"], 'id'=>$svs[0]["tid"], 'svstyp'=>'Tent', 'size'=>$svs[0]["size"], 'people'=>$svs[0]["people"], 'uid'=>$svs[0]["uid"], 'quantity'=>$_POST["quantity"], 'price'=>$svs[0]["price"]));
		}	
	else if($svstp == 'seats'){
      //Seats
  $serviceArray = array($svs[0]["code"]=>array('companyName'=>$svs[0]["companyName"], 'location'=>$svs[0]["c_location"], 'code'=>$svs[0]["code"], 'id'=>$svs[0]["sid"], 'svstyp'=>'Seat', 'size'=>'', 'people'=>'', 'uid'=>$svs[0]["uid"], 'quantity'=>$_POST["quantity"], 'price'=>$svs[0]["price"]));
		}	
		else if($svstp == 'equips'){
      //equipment
  $serviceArray = array($svs[0]["code"]=>array('companyName'=>$svs[0]["companyName"], 'location'=>$svs[0]["c_location"], 'code'=>$svs[0]["code"], 'id'=>$svs[0]["eid"], 'svstyp'=>'Equipment', 'size'=>'', 'people'=>'', 'uid'=>$svs[0]["uid"], 'quantity'=>$_POST["quantity"], 'price'=>$svs[0]["price"]));
		}	
		else if($svstp == 'caters'){
      //Catering
  $serviceArray = array($svs[0]["code"]=>array('companyName'=>$svs[0]["companyName"], 'location'=>$svs[0]["c_location"], 'code'=>$svs[0]["code"], 'id'=>$svs[0]["cid"], 'svstyp'=>'Catering', 'size'=>'', 'people'=>'', 'uid'=>$svs[0]["uid"], 'quantity'=>$_POST["quantity"], 'price'=>$svs[0]["price"]));
		}	
		else if($svstp == 'venues'){
      //Venues
  $serviceArray = array($svs[0]["code"]=>array('companyName'=>$svs[0]["companyName"], 'location'=>$svs[0]["c_location"], 'code'=>$svs[0]["code"], 'id'=>$svs[0]["vid"], 'svstyp'=>'Venue', 'size'=>'', 'people'=>$svs[0]["people"], 'uid'=>$svs[0]["uid"], 'quantity'=>$_POST["quantity"], 'price'=>$svs[0]["price"]));
		}

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($svs[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($svs[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$serviceArray);
				}
			} else {
				$_SESSION["cart_item"] = $serviceArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EESBS: Order</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

 <link href="myassets/mystyles.css" type="text/css" rel="stylesheet" />

 <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
   <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" />
  <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"> </script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
<script src="myassets/myscripts.js"></script>

  <link rel="stylesheet" href="datepicker/css/jquery-ui.css">
  <script src="datepicker/js/jquery-1.10.2.js"></script>
  <script src="datepicker/js/jquery-ui.js"></script>

 <script type="text/javascript">
  //Show/Hide divs
  //Upon loading, show Tents alone, Hide the others
  $(document).ready(
  function(){$('.others').hide();
  });

  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: "dd/mm/yy",minDate: new Date()});
  });
  </script> 

	<style type="text/css">
	 th, td{
	text-align:center;}
	.hname{
	font-size:18px;
	margin-left:50%;}

.txt-heading{padding: 5px 10px;font-size:1.1em;font-weight:bold;color:#999;}
.btnRemoveAction{color:#D60202;border:0;padding:2px 10px;font-size:0.9em;}
#btnEmpty{background-color:#D60202;border:0;padding:1px 10px;color:#FFF; font-size:0.8em;font-weight:normal;float:right;text-decoration:none;}
.btnAddAction{background-color:#79b946;border:0;padding:3px 10px;color:#FFF;margin-left:1px;}
#shopping-cart {border-top: #79b946 2px solid;margin-bottom:30px;}
#shopping-cart .txt-heading{background-color: #D3F5B8;}
#shopping-cart table{width:100%;background-color:#F0F0F0;}
#shopping-cart table td{background-color:#FFFFFF;}
.cart-item {border-bottom: #79b946 1px dotted;padding: 10px;}
#product-grid {border-top: #F08426 2px solid;margin-bottom:30px;}
#product-grid .txt-heading{background-color: #FFD0A6;}
.product-item {	float:left;	background:#F0F0F0;	margin:15px;	padding:5px;}
.product-item div{text-align:center;	margin:10px;}
.product-price {color:#F08426;}
.product-image {height:100px;background-color:#FFF; wwidth:10px;}
	</style>
</head>

<body>
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">EESBS</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
				<?php if(isset($_SESSION["is_logged"])){ if($_SESSION["role"] == 1){?>
					<li><a href="dashboard.php">Dashboard</a></li>
			<?php } else{?>
				<li class="active"><a href="admin.php">Admin</a></li>
			<?php }} ?>
        <li><a href="services.php">Services</a></li>
        <li class="active"><a href="order.php">Order</a></li>
        <li><a href="message.php">Message</a></li>
		<li><a href="#">Contact Us</a></li>
      </li>
        <?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;		
    foreach ($_SESSION["cart_item"] as $item){
	 $item_total += ($item["price"]*$item["quantity"]);
} ?>
<li><button type='button' class='btn btn-success' data-toggle='modal' data-target='#ModalCart'>
		<font color=white >Cart <span class="glyphicon glyphicon-shopping-cart"> </span><span class="badge"><?php echo $item_total;?></span> </font></button>
		</li>
<?php }	?>
<!-- Receipt-->
<?php
if(isset($_SESSION["items"])){?>
<li><a href="includes/receipt.php"> <font color=white><button> <span class="badge">Download Receipt</span></button></font> </a> 
</li>
<?php }	?>
<!--End of receipt-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
	  <?php if(isset($_SESSION["is_logged"])){?>
	     <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"];?></a></li>
		<li><a href="includes/signlogin.php?out"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	  <?php } else{ ?>
        <li><a data-toggle="modal" data-target="#ModalSign"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		<li><a data-toggle="modal" data-target="#ModalLogin"> <span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container panel panel-default head" style="mmargin-top:30%;">
    <div class="panel-heading panel-success"><h3>Order Services</h3></div>
</div>

<!-- Shopping cart -->
<?php include("cart.php"); ?>
<!-- Shopping Cart -->

<div class="container panel panel-default cont">
      <div class="panel-body panel-primary">
			<?php if(isset($_SESSION["fail"])){?>
      <?php $echo = $_SESSION["fail"]; ?>
    <div class="alert alert-warning" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-warning-sign"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['fail']); } ?>

	<?php if(isset($_SESSION["success"])){?>
      <?php $echo = $_SESSION["success"]; ?>
    <div class="alert alert-success" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-ok"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['success']); } ?>
	  <!-- Tents division -->


	  <div class="bg-primary"><span class="glyphicon glyphicon-minus" id="tentsign"></span><span class="hname bg-primary">Tents</span></div>
	  <div class="panel panel-primary tents" sstyle="background-color:#F5F4F1; border-radius:5px;">
      <div class="panel-body bg-primary">
	    <?php
	if (!empty($tents)) { 
		foreach($tents as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="order.php?action=add&svs=tent&code=<?php echo $tents[$key]["code"]; ?>">
			<div class="product-image"><img width="120px" height="100px" src="<?php echo $tents[$key]["image"]; ?>"></div>
            <div class="text-primary"><?php echo $tents[$key]["c_location"]; ?></div>
			<div class="text-primary"><strong><?php echo $tents[$key]["size"]; ?></strong></div>
            <div class="text-primary"><em><?php echo $tents[$key]["people"]." people"; ?></em></div>
			<div class="product-price"><?php echo "KShs ".$tents[$key]["price"]; ?></div>
			<div><input class="text-primary" type="text" name="quantity" onKeyPress="return numbersonly(event)" value="1" size="2" /><input class="btn-primary" type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	  </div>
      </div>
	  
	  
	  	  <!-- Seats division -->
	  <div class="bg-success"><a><span class="glyphicon glyphicon-plus" id="seatsign"></span></a><span class="hname">Seats</span></div>
	  <div class="panel panel-success seats others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   <div class="panel-body bg-success">
	    <?php
	if (!empty($seats)) { 
		foreach($seats as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="order.php?action=add&svs=seats&code=<?php echo $seats[$key]["code"]; ?>">
			<div class="product-image"><img width="120px" height="100px" src="<?php echo $seats[$key]["image"]; ?>"></div>
            <div class="text-success"><?php echo $seats[$key]["c_location"]; ?></div>
			<div class="product-price"><?php echo "KShs ".$seats[$key]["price"]; ?></div>
			<div><input class="text-success" type="text" name="quantity" onKeyPress="return numbersonly(event)" value="1" size="2" /><input class="btn-success" type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	  </div>
	  </div>
	  
	  
	  	  <!-- Equipment division -->
	  <div class="bg-warning"><a><span class="glyphicon glyphicon-plus" id="equipsign"></span></a><span class="hname">Equipment</span></div>
	  <div class="panel panel-warning equips others" sstyle="background-color:#F5F4F1; border-radius:5px;">
      	   <div class="panel-body bg-warning">
	    <?php
	if (!empty($equips)) { 
		foreach($equips as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="order.php?action=add&svs=equips&code=<?php echo $equips[$key]["code"]; ?>">
			<div class="product-image"><img width="120px" height="100px" src="<?php echo $equips[$key]["image"]; ?>"></div>
            <div class="text-warning"><?php echo $equips[$key]["c_location"]; ?></div>
			<div class="product-price"><?php echo "KShs ".$equips[$key]["price"]; ?></div>
			<div><input class="text-warning" type="text" name="quantity" onKeyPress="return numbersonly(event)" value="1" size="2" /><input class="btn-warning" type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	  </div>
	  </div>
	  
	 	  <!-- Catering division -->
	  <div class="bg-info"><a><span class="glyphicon glyphicon-plus" id="catsign"></span></a><span class="hname">Catering</span></div>
	  <div class="panel panel-info cater others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   	   <div class="panel-body bg-info">
	    <?php
	if (!empty($caters)) { 
		foreach($caters as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="order.php?action=add&svs=caters&code=<?php echo $caters[$key]["code"]; ?>">
			<div class="product-image"><img width="120px" height="100px" src="<?php echo $caters[$key]["image"]; ?>"></div>
            <div class="text-info"><?php echo $caters[$key]["c_location"]; ?></div>
			<div class="product-price"><?php echo "KShs ".$caters[$key]["price"]; ?></div>
			<div><input class="text-info" type="text" name="quantity" onKeyPress="return numbersonly(event)" value="1" size="2" /><input class="btn-info" type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	  </div>
	  </div>
	  
	    	  <!-- Venues division -->
	  <div class="bg-danger"><a><span class="glyphicon glyphicon-plus" id="venuesign"></span></a><span class="hname">Venues</span></div>
	  <div class="panel panel-danger venue others" sstyle="background-color:#F5F4F1; border-radius:5px;">
      	  	   	   <div class="panel-body bg-danger">
	    <?php
	if (!empty($venues)) { 
		foreach($venues as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="order.php?action=add&svs=venues&code=<?php echo $venues[$key]["code"]; ?>">
			<div class="product-image"><img width="120px" height="100px" src="<?php echo $venues[$key]["image"]; ?>"></div>
            <div class="text-danger"><?php echo $venues[$key]["c_location"]; ?></div>
            <div class="text-danger"><?php echo $venues[$key]["people"]." people"; ?></div>
			<div class="product-price"><?php echo "KShs ".$venues[$key]["price"]; ?></div>
			<div><input class="text-danger" type="text" name="quantity" onKeyPress="return numbersonly(event)" value="1" size="2" /><input class="btn-danger" type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	  </div>
	  </div>
	  
	  </div>
     
 <?php include("includes/footer.php"); ?>
</div>

 <?php include("includes/signlogin.php"); ?>

<script>
  //Show/Hide divs	
  //#1 - Tents div
	$("#tentsign").click(function(){
	
        $(".tents").slideToggle("slow");
		var sign = document.getElementById("tentsign");
		var cls = sign.getAttribute("class");
		
		if(cls == 'glyphicon glyphicon-plus'){
		sign.setAttribute("class", "glyphicon glyphicon-minus");
		}else{
		sign.setAttribute("class", "glyphicon glyphicon-plus");
		}
    });
	
	
	   //#2 - Equipment div
	$("#equipsign").click(function(){
	
        $(".equips").slideToggle("slow");
		var sign = document.getElementById("equipsign");
		var cls = sign.getAttribute("class");
		
		if(cls == 'glyphicon glyphicon-plus'){
		sign.setAttribute("class", "glyphicon glyphicon-minus");
		}else{
		sign.setAttribute("class", "glyphicon glyphicon-plus");
		}
    });
	
	
	//#3 - Catering div
	$("#catsign").click(function(){
	
        $(".cater").slideToggle("slow");
		var sign = document.getElementById("catsign");
		var cls = sign.getAttribute("class");
		
		if(cls == 'glyphicon glyphicon-plus'){
		sign.setAttribute("class", "glyphicon glyphicon-minus");
		}else{
		sign.setAttribute("class", "glyphicon glyphicon-plus");
		}
	});
		
		//#4 - Venues div
	$("#venuesign").click(function(){
	
        $(".venue").slideToggle("slow");
		var sign = document.getElementById("venuesign");
		var cls = sign.getAttribute("class");
		
		if(cls == 'glyphicon glyphicon-plus'){
		sign.setAttribute("class", "glyphicon glyphicon-minus");
		}else{
		sign.setAttribute("class", "glyphicon glyphicon-plus");
		}
	   });
		
		//#5 - Seats div
	$("#seatsign").click(function(){
	
        $(".seats").slideToggle("slow");
		var sign = document.getElementById("seatsign");
		var cls = sign.getAttribute("class");
		
		if(cls == 'glyphicon glyphicon-plus'){
		sign.setAttribute("class", "glyphicon glyphicon-minus");
		}else{
		sign.setAttribute("class", "glyphicon glyphicon-plus");
		}
    });
	  </script>
</body>
</html>
