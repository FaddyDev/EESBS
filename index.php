<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("includes/dbconn.php"); //Create db first ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EESBS: Home</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

 <link href="myassets/mystyles.css" type="text/css" rel="stylesheet" />

 <link href="bootstrap-3.3.7-dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
   <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.css" type="text/css" rel="stylesheet" />
  <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.js"> </script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
  <script src="myassets/myscripts.js"></script>

    <link rel="stylesheet" href="datepicker/css/jquery-ui.css">
  <script src="datepicker/js/jquery-1.10.2.js"></script>
  <script src="datepicker/js/jquery-ui.js"></script>

 <script>
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: "dd/mm/yy",minDate: new Date()});
  });
  </script>

  	<style type="text/css">
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
			height: 322px;
  }
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
        <li class="active"><a href="index.php">Home</a></li>
        <?php if(isset($_SESSION["is_logged"])){ if($_SESSION["role"] == 1){?>
					<li><a href="dashboard.php">Dashboard</a></li>
			<?php } else{?>
				<li class="active"><a href="admin.php">Admin</a></li>
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

<?php include("includes/head.php"); //Heading ?>

<!-- Shopping cart -->
<?php include("cart.php"); ?>
<!-- Shopping Cart -->

<div class="container panel panel-default cont">
      <div class="panel-body panel-primary">
  <?php if(isset($_SESSION["fail"])){?>
      <?php $echo = $_SESSION["fail"]; ?>
    <div class="alert alert-warning" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-warning-sign"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['fail']); } ?>
      <?php include("includes/slider.php"); ?>	
       <!-- Column1 -->
	  <div class="col-md-4 jjumbotron well" style="min-height: 37vh; border:thin #FFDFFF dotted;">
	  <h5><strong>Welcome</strong></h5>
    <p style="text-align:justify;">Welcome to the Event and Equipment Services Booking System (EESBS). Yes, as the name suggests, we deal with five types of services 
    namely; tents, catering, equipment, veneues (conference halls) and catering. We are the 'middle man' between events services providers
    and customers seeking such services. We bring together all these services from a maltitude of providers into a one-stop-shop setting
    for the convenience of customers. Go through the friendly links to find out more.</p>
	  </div>
	  
	  <!-- Column2 -->
	  <div class="col-md-4 well" style="min-height: 37vh; border:thin #FFDFFF dotted;">
	  <h5><strong>Service Providers</strong></h5>
    <p style="text-align:justify;">Do you offer event management services? do you hire out tents? equipment? conference halls? catering?
    equipment like public address? If so then you're in the right place. At EESBS we recognize that you need a bigger customer base and that
    we have for you. We give you a chance to connect with potential customers from allover the country. All you need to do is register with 
    us for free <a data-toggle="modal" data-target="#ModalSign">here</a> then add the services you offer. Customers will select your services and we will notify you so that 
    you do the delivery and give us a small (10%) commission. It is that simple.</p>
	  </div>
	  
	  <!-- Column3 -->
	  <div class="col-md-4 well" style="min-height: 37vh; border:thin #FFDFFF dotted;">
	  <h5><strong>Customers</strong></h5>
    <p style="text-align:justify;">Are you looking for event services? at EESBS we have all the event services from many service
    providers across the country. You can select those near you or simply the best that you like and we will have them deliver to you. We 
    give you a platform where you can request for services from different providers at the same time. Welcome...</p>
	  </div>
	  </div>
     
 <?php include("includes/footer.php"); ?>
</div>

 <?php include("includes/signlogin.php"); ?>


</body>
</html>
