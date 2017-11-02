<?php if(session_status()==PHP_SESSION_NONE){
session_start();} 
include("includes/dbconn.php"); //DB?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EESBS: Message</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

 <link href="myassets/mystyles.css" type="text/css" rel="stylesheet" />

 <link href="bootstrap-3.3.7-dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
   <link href="bootstrap-3.3.7-dist/css/bootstrap-theme.css" type="text/css" rel="stylesheet" />
  <script src="bootstrap-3.3.7-dist/js/jquery-3.2.1.js"> </script>
  <script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>
  <script src="myassets/myscripts.js"></script>

    <style type="text/css">
/* Large desktops and laptops */
@media (min-width: 1200px) {
.mydiv{
    width:50%; margin:auto;margin-top:3%;
}
}

/* Landscape tablets and medium desktops */
@media (min-width: 992px) and (max-width: 1199px) {
.mydiv{
    width:50%; margin:auto;margin-top:2%;
}
}

/* Portrait tablets and small desktops */
@media (min-width: 768px) and (max-width: 991px) {
.mydiv{
    width:70%; margin:auto;margin-top:2%;
}
}

/* Landscape phones and portrait tablets */
@media (max-width: 767px) {
.mydiv{
    width:90%; margin:auto;margin-top:2%;
}
}

/* Portrait phones and smaller */
@media (max-width: 480px) {
.mydiv{
    width:99%; margin:auto;margin-top:1%;
}
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
        <li><a href="index.php">Home</a></li>
       <?php if(isset($_SESSION["is_logged"])){?>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="#">Update Services</a></li>
		<?php }?>
        <li><a href="services.php">Services</a></li>
        <li><a href="order.php">Order</a></li>
        <li class="active"><a href="message.php">Message</a></li>
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
<div class="panel panel-primary mydiv">
    <div class="panel-heading">Leave a message</div>
      <div class="panel-body">

<?php 
if(isset($_POST['msg'])){
 $response = 'None'; $replied = 0;
   try {    $sql = "INSERT INTO messages (uid, message, response, phone, replied)
    VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	  $stmt -> bindParam(1, $_POST['uid']);
	  $stmt -> bindParam(2, $_POST['message']);
	  $stmt -> bindParam(3, $response);
    $stmt -> bindParam(4, $_POST['phone']);
    $stmt -> bindParam(5, $replied);
    $stmt->execute();
    
    $_SESSION['success'] = "Message submitted successfully. Response will be send to ".$_POST['phone'];
    //echo "<meta http-equiv='refresh' content='0;url=message.php'> ";?>
<script>
window.location.href = 'message.php';
</script>
<?php
    }
catch(PDOException $e)
    {
    echo "<div style='height:auto; width:50%; color:#000000; margin:auto;top:100px; background-color:#cc7a00; border-radius:5px;border-style: solid; border-width:thin;border-color: red;'>".$sql . "<br>" . $e->getMessage()." <br>Go back and retry.</div>";
    }
$stmt = null;
}else{
  $sps = array();
  try { 
  
    $sql = "SELECT * FROM s_providers WHERE active=1 AND companyName != 'N/A'";
      $stmt = $conn->prepare($sql);
    if($stmt->execute())
    {
     while($row = $stmt -> fetch())
     {
       $sps[] = $row;
     }
    } 
    }
  catch(PDOException $e)
      {
      echo "<div style='height:auto; width:50%; color:#000000; margin:auto;top:100px; background-color:#cc7a00; border-radius:5px;border-style: solid; border-width:thin;border-color: red;'>".$sql . "<br>" . $e->getMessage()." <br>Go back and retry.</div>";
     }
  $stmt = null;	
   ?>
<?php if(isset($_SESSION["success"])){?>
      <?php $echo = $_SESSION["success"]; ?>
    <div class="alert alert-success" style="text-align:center;" role="alert"><span class="glyphicon glyphicon-ok"></span> <?php echo $echo; ?> </div>
  <?php  unset($_SESSION['success']); } ?>

<form action="message.php" class="form-group" method="post">
<p>
<label>Select recipient</label></br>
<select class="form-control add-todo" name="uid" required/>
<option value="0">Admin</option>
 <?php foreach ($sps as $sp){?>
<option value="<?php echo $sp['uid'];?>"><?php echo $sp['companyName'];?> </option>
		  <?php }?>
</select>
</p>

<p>
<label>Message</label></br>
<textarea name="message" style="width:100%;" rows="10" placeholder="Enter your message here" required></textarea>
</p>

<p>
<label>Phone Number</label></br>
<input type="text" name="phone" class="form-control add-todo" placeholder="Enter your mobile phone number" onKeyPress="return numbersonly(event)" required />
</p>

<p>
<input type="submit" name="msg" class="btn btn-info" style="float: right;" value="Submit" id="submit1">
</p>	

</form>
<?php } ?> 
  </div>
  </div> 
 <?php include("includes/footer.php"); ?>
</div>

 <?php include("includes/signlogin.php"); ?>
