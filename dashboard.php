<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("includes/dbconn.php"); //DB
$data = array();
try {    $sql = "SELECT * FROM s_providers TRY WHERE username = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["username"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $data = $row;
	 }
	} 
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
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
<title>EESBS</title>
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

 <script>
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: "dd/mm/yy",minDate: new Date()});
  });
  </script>
  
  <script type="text/javascript">
   /* $(document).ready(
  function(){$('.others').hide();
  });*/
  $(document).ready(function(){
  var hash = document.location.hash;
  if(hash){
    //alert(hash);
   // $('.nav-tabs a[href='+hash+']').tab('show');
   //if(hash == '#services'){
     /*document.getElementById("prof").setAttribute("class", "tab-pane fade in");
     document.getElementById("services").setAttribute("class", "tab-pane fade in active");*/
     
 $('.nav-tabs a[href='+hash+']').tab('show');
  }
 // }
  //alert("No-hash");
  //Changing hash for page reload
  $('.nav-tabs a').on('shown.bs.tab', function(e){
    window.location.hash = e.target.hash;
  });
   });

   $(document).ready(function(){
  var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("prof").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/profile.php",true);
xmlhttp.send();
  });
  </script>
  
  <style type="text/css">
  #servicetbl td{
padding:2%;
}
.add-todo{
padding:2%;}
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
          <li class="active"><a href="dashboard.php">Dashboard</a></li>
      <?php } else{?>
        <li><a href="admin.php">Admin</a></li>
      <?php }} ?>
        <li><a href="services.php">Services</a></li>
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
    <div class="panel-heading panel-success"><h3><?php echo $data['companyName'];?> Dashboard</h3></div>
</div>

<!-- Shopping cart -->
<?php include("cart.php"); ?>
<!-- Shopping Cart -->

<!-- Main content goes here -->	
<div class="container panel panel-default cont">
      <div class="panel-body panel-primary">
      
      <?php if(isset($_SESSION["success"])){?>
      <?php $echo = $_SESSION["success"]; ?>
    <div class="alert alert-success" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-ok"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['success']); } ?>
  
	  <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" id="prfbtn" href="#prof">Profile</a></li>
  <li><a data-toggle="tab" id="svsbtn" href="#services">My Services</a></li>
  <li><a data-toggle="tab" id="ordbtn" href="#orders">Orders</a></li>
  <li><a data-toggle="tab" id="fnbtn" href="#finances">Finances</a></li>
  <li><a data-toggle="tab" id="msgbtn" href="#messages">Messages</a></li>
</ul>


<div class="tab-content">

<!-- My profile tab -->
  <div id="prof" class="tab-pane fade in active">
    </div>
  
  
  
  <!-- My services tab -->
  <div id="services" class="tab-pane fade">
   </div>
  
  <!-- My orders tab -->
  <div id="orders" class="tab-pane fade">
  </div>

   <div id="finances" class="tab-pane fade">
  </div>
   <div id="messages" class="tab-pane fade">
  </div>
</div>


	  
	  </div>
     
 <?php include("includes/footer.php"); ?>
</div>

 <?php include("includes/signlogin.php"); ?>


<script type="text/javascript">
 //Profile
 $("#prfbtn").click(function(){ var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("prof").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/profile.php",true);
xmlhttp.send();
   });

   //Services
 $("#svsbtn").click(function(){ var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("services").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/myservices.php",true);
xmlhttp.send();
   });

    //orders
 $("#ordbtn").click(function(){ var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("orders").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/myorders.php",true);
xmlhttp.send();
   });

   //finaces
 $("#fnbtn").click(function(){ var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("finances").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/myfinances.php",true);
xmlhttp.send();
   });

      //Messages
      $("#msgbtn").click(function(){ var xmlhttp;
    if(window.XMLHttpRequest){
      //for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else{
      //for IE6 n 5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
xmlhttp.onreadystatechange=function(){
  if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
    document.getElementById("messages").innerHTML = xmlhttp.responseText;
  }
}
xmlhttp.open("POST","SProvider/messages.php",true);
xmlhttp.send();
   });
	  </script>
</body>
</html>






