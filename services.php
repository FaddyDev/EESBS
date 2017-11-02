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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EESBS: Services</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

 <link href="myassets/mystyles.css" type="text/css" rel="stylesheet" />

 <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
   <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" type="text/css" rel="stylesheet" />
  <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.min.js"> </script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	  <link rel="stylesheet" href="datepicker/css/jquery-ui.css">
  <script src="datepicker/js/jquery-1.10.2.js"></script>
  <script src="datepicker/js/jquery-ui.js"></script>

 <script>
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: "dd/mm/yy",minDate: new Date()});
  });
  </script>
  
 <script type="text/javascript">
  //Show/Hide divs
  //Upon loading, show Tents alone, Hide the others
  $(document).ready(
  function(){$('.others').hide();
  });
  </script> 
  
  <!--DataTable-->
	  <script type="text/javascript">
  $(document).ready(
  function(){$('#tentstable').DataTable();
  });
  
  $(document).ready(
  function(){$('#equiptable').DataTable();
  });
  
  $(document).ready(
  function(){$('#catertable').DataTable();
  });
  
   $(document).ready(
  function(){$('#venuetable').DataTable();
  });
  
   $(document).ready(
  function(){$('#seatstable').DataTable();
  });
  </script>
	<script type="text/javascript" src="myassets/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="myassets/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="myassets/dataTables.bootstrap.min.css"/>
	<style type="text/css">
	 th, td{
	text-align:center;}
	.hname{
	font-size:18px;
	margin-left:50%;}
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
        <li class="active"><a href="services.php">Services</a></li>
        <li><a href="order.php">Order</a></li>
        <li><a href="message.php">Message</a></li>
		<li><a href="#">Contact Us</a></li>
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
    <div class="panel-heading panel-success"><h3>All Services</h3></div>
</div>

<!-- Shopping cart -->
<?php include("cart.php"); ?>
<!-- Shopping Cart -->
<div class="container panel panel-default cont">
      <div class="panel-body panel-primary">
	  
	  <!-- Tents division -->
	  <div class="bg-primary"><span class="glyphicon glyphicon-minus" id="tentsign"></span><span class="hname bg-primary">Tents</span></div>
	  <div class="panel panel-primary  table-responsive tents" sstyle="background-color:#F5F4F1; border-radius:5px;">
	    <table   class="table table-striped table-hover table-bordered table-condensed" id="tentstable">
		<thead>
          <tr>
		    <th>Company Name</th>
			<th>Location</th>
            <th>Image</th>
			<th>Size</th>
            <th>People(#)</th>
            <th>Charges</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($tents as $tent){?>
		  <tr><td><?php echo $tent['companyName'];?></td>
		  <td><?php echo $tent['c_location'];?></td>
		  <td><img src="<?php echo $tent['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $tent['size'];?></td>
		  <td><?php echo $tent['people'];?></td>
		  <td><?php echo $tent['price'];?></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	    	  <!-- Seats division -->
	  <div class="bg-success"><a><span class="glyphicon glyphicon-plus" id="seatsign"></span></a><span class="hname">Seats</span></div>
	  <div class="panel panel-success table-responsive seats others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="seatstable">
		<thead>
          <tr>
		    <th>Company Name</th>
			<th>Location</th>
            <th>Image</th>
			<th>Quantity</th>
            <th>Charges</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($seats as $seat){?>
		  <tr><td><?php echo $seat['companyName'];?></td>
		  <td><?php echo $seat['c_location'];?></td>
		  <td><img src="<?php echo $seat['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $seat['quantity'];?></td>
		  <td><?php echo $seat['price'];?></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	  	  <!-- Equipment division -->
	  <div class="bg-warning"><a><span class="glyphicon glyphicon-plus" id="equipsign"></span></a><span class="hname">Equipment</span></div>
	  <div class="panel panel-warning table-responsive equips others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="equiptable">
		<thead>
          <tr>
		    <th>Company Name</th>
			<th>Location</th>
		    <th>Type</th>
            <th>Image</th>
            <th>Charges</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($equips as $equip){?>
		  <tr><td><?php echo $equip['companyName'];?></td>
		  <td><?php echo $equip['c_location'];?></td>
		  <td><?php echo $equip['type'];?></td>
		  <td><img src="<?php echo $equip['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $equip['price'];?></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	 	  <!-- Catering division -->
	  <div class="bg-info"><a><span class="glyphicon glyphicon-plus" id="catsign"></span></a><span class="hname">Catering</span></div>
	  <div class="panel panel-info table-responsive cater others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="catertable">
		<thead>
          <tr>
		    <th>Company Name</th>
			<th>Location</th>
		    <th>Type</th>
            <th>Image</th>
			<th>Menu</th>
            <th>Charges</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($caters as $cater){?>
		  <tr><td><?php echo $cater['companyName'];?></td>
		  <td><?php echo $cater['c_location'];?></td>
		  <td><?php echo $cater['type'];?></td>
		  <td><img src="<?php echo $cater['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $cater['menu'];?></td>
		  <td><?php echo $cater['price'];?></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	    	  <!-- Venues division -->
	  <div class="bg-danger"><a><span class="glyphicon glyphicon-plus" id="venuesign"></span></a><span class="hname">Venues</span></div>
	  <div class="panel panel-danger table-responsive venue others" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="venuetable">
		<thead>
          <tr>
		    <th>Company Name</th>
			<th>Location</th>
            <th>Image</th>
			<th>People (#)</th>
            <th>Charges</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($venues as $venue){?>
		  <tr><td><?php echo $venue['companyName'];?></td>
		  <td><?php echo $venue['c_location'];?></td>
		  <td><img src="<?php echo $venue['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $venue['people'];?></td>
		  <td><?php echo $venue['price'];?></td></tr>
		  <?php }?>
		  </tbody>
        </table>
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
