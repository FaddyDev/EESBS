<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 
if(isset($_GET['req'])){?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EESBS</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

 <link href="../myassets/mystyles.css" type="text/css" rel="stylesheet" />

 <link href="../bootstrap-3.3.7-dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
   <link href="../bootstrap-3.3.7-dist/css/bootstrap-theme.css" type="text/css" rel="stylesheet" />
  <script src="../bootstrap-3.3.7-dist/js/jquery-3.2.1.js"> </script>
  <script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
  <script src="../myassets/myscripts.js"></script>

    <link rel="stylesheet" href="../datepicker/css/jquery-ui.css">
  <script src="../datepicker/js/jquery-1.10.2.js"></script>
  <script src="../datepicker/js/jquery-ui.js"></script>

 <script>
  $(function() {
    $( ".datepicker" ).datepicker({dateFormat: "dd/mm/yy",minDate: new Date()});
  });
  </script>

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
        <li><a href="../index.php">Home</a></li>
       <?php if(isset($_SESSION["is_logged"])){?>
        <li><a href="../dashboard.php">Dashboard</a></li>
        <li class="active"><a href="#">Update Services</a></li>
		<?php }?>
        <li><a href="../services.php">Services</a></li>
        <li><a href="../order.php">Order</a></li>
        <li><a href="../message.php">Message</a></li>
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
		<li><a href="../includes/signlogin.php?out"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	  <?php } else{ ?>
        <li><a data-toggle="modal" data-target="#ModalSign"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		<li><a data-toggle="modal" data-target="#ModalLogin"> <span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		<?php } ?>
      </ul>
    </div>
  </div>
</nav>

<?php include("../includes/head.php"); //Heading ?>

<!-- Shopping cart -->
<?php include("../cart.php"); ?>
<!-- Shopping Cart -->

<div class="container panel panel-default cont">
      <div class="panel-body panel-primary">

  <?php  if($_GET['req'] == 'edit'){ //for files requiring editing
$tents = array(); $equips = array(); $caters = array(); $venues = array(); $seats = array();
try { 
  //Tents
if($_GET['svs'] == 'tent'){ //for editing tents
  $sql = "SELECT * FROM tents TRY WHERE uid = ? AND tid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"],$_GET['id'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $tents[] = $row;
	 }
	}
}//End of tent

	 //Equipment
if($_GET['svs'] == 'equip'){ //for editing equipment
  $sql = "SELECT * FROM equipment TRY WHERE uid = ? AND eid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"],$_GET['id'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $equips[] = $row;
	 }
	} 
}//End of equipment

	//Venues	
 if($_GET['svs'] == 'venue'){ //for editing venues
  $sql = "SELECT * FROM venues TRY WHERE uid = ? AND vid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"],$_GET['id'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $venues[] = $row;
	 }
	}
}//End of venues 

//Seats
if($_GET['svs'] == 'seat'){ //for editing seats
  $sql = "SELECT * FROM seats TRY WHERE uid = ? AND sid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"],$_GET['id'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $seats[] = $row;
	 }
	} 
}//End of seats

//Catering	
if($_GET['svs'] == 'cat'){ //for editing catering
  $sql = "SELECT * FROM catering TRY WHERE uid = ? AND cid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"],$_GET['id'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $caters[] = $row;
	 }
	}
}//End of catering 
  }//end of try
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 
    if($_GET['svs'] == 'tent'){ //for editing tents
?>
 
  <!--Tents div-->
      <div class="panel panel-primary mydiv">
 <?php foreach ($tents as $tent){?>
	  <form action="editservices.php" class="form-group" method="post" name="tentsform" onsubmit="return select1();" enctype="multipart/form-data">
	  <input type="hidden" name="tid" value="<?php echo $tent['tid'];?>" />
	  <table id="servicetbl">
<tr><td colspan="4" style="font-weight:bold;">Select the type of tent</td></tr>
<tr><td colspan="4"><input type="radio" name="type" value="<?php echo $tent['type'];?>" checked="checked" required> Current Type: <img src="<?php echo '../'.$tent['image'];?>" class="img-rounded" alt="" width="100" height="100"></td></tr>
<tr>
<td><input type="radio" name="type" value="typeA" required> <img src="../images/tents/1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeB" required> <img src="../images/tents/2.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeC" required> <img src="../images/tents/3.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeD" required> <img src="../images/tents/4.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><em>Current Photo</em></td></tr>
<tr><td colspan="4"><img src="<?php echo '../'.$tent['image'];?>" class="img-rounded" alt="Current photo" width="100" height="100">
<input type="hidden" name="oldphoto" value="<?php echo $tent['image'];?>"></td></tr>
<tr><td colspan="4" style="font-weight:bold;">Upload a new photo of your tent:</td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" ></td></tr>

<tr><td colspan="4" style="font-weight:bold;">Size</td></tr>
<tr><td colspan="4"><em>Current:</em> <input type="radio" name="size" checked="checked" value="<?php echo $tent['size'];?>"> <?php echo $tent['size'];?> </td></tr>
<tr><td><input type="radio" name="size"  value="20x30"> 20x30 </td>
<td><input type="radio" name="size"  value="30x60"> 30x60 </td>
<td><input type="radio" name="size"  value="40x60"> 40x60 </td>
<td><input type="radio" name="size"  value="40x90"> 40x90 </td></tr>

<tr><td colspan="4" style="font-weight:bold;">Price (KShs.)</td></tr>
<tr><td colspan="4">
<input type="text" name="price" class="form-control add-todo" value="<?php echo $tent['price'];?>" onKeyPress="return numbersonly(event)" placeholder="Price of the tent"/></td></tr>
<tr><td colspan="4">
<input type="submit" name="updateTent" class="btn btn-info btn-block" value="Update" id="submit"></td></tr>
</table>		
</form>
<?php } //end of foreach
    ?>
</div>
<?php 
    } //end of get tent 
    ?>
<!--End of tents div -->

  <!--Seats div-->
<?php    if($_GET['svs'] == 'seat'){ //for editing seats
?>
<div class="panel panel-success mydiv">
 <?php foreach ($seats as $seat){?>
	  <form action="editservices.php" class="form-group" method="post" enctype="multipart/form-data">
<input type="hidden" name="sid" value="<?php echo $seat['sid'];?>" />
 <table id="servicetbl">
<tr><td colspan="4" style="font-weight:bold;">Select the type of seat</td></tr>
<tr><td colspan="4">Current type<input type="radio" name="type" value="<?php echo $seat['type'];?>" checked="checked" required><img src="<?php echo '../'.$seat['image'];?>" class="img-rounded" alt="" width="100" height="100"></td></tr>
<tr><td><input type="radio" name="type" value="typeA" cclass="form-control add-todo" required> <img src="../images/seats/1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeB" cclass="form-control add-todo" required> <img src="../images/seats/2.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeC" cclass="form-control add-todo" required> <img src="../images/seats/3.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeD" cclass="form-control add-todo" required> <img src="../images/seats/4.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><em>Current Photo</em></td></tr>
<tr><td colspan="4"><img src="<?php echo '../'.$seat['image'];?>" class="img-rounded" alt="Current photo" width="100" height="100">
<input type="hidden" name="oldphoto" value="<?php echo $seat['image'];?>"></td></tr>
<tr><td colspan="4" style="font-weight:bold;">Upload a new photo of the seat:</td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo"></td></tr>

<tr><td colspan="4" style="font-weight:bold;">Enter the number of seats available:</td></tr>
<tr><td colspan="4"><input type="text" name="qty" value="<?php echo $seat['quantity'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Quantity" required/></td></tr>

<tr><td colspan="4" style="font-weight:bold;">Enter the amount you charge for each seat of the selected type (KShs.):</td></tr>
<tr><td colspan="4"><input type="text" name="price" value="<?php echo $seat['price'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>
<tr><td colspan="4">
<input type="submit" name="updateSeat" class="btn btn-info btn-block" value="Update" id="submit"></td></tr>	
</table>		
</form>
 <?php } //end of foreach
    ?>
 </div>
 <?php 
    } //end of get seat 
    ?>
<!--End of seats div -->

 <!--catering div-->
 <?php    if($_GET['svs'] == 'cat'){ //for editing catering
?>
      <div class="panel panel-danger mydiv">
      <?php foreach ($caters as $cater){?>
	  <form action="editservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="cid" value="<?php echo $cater['cid'];?>" />
	  <table id="servicetbl">
<tr><td colspan="2" style="font-weight:bold;">Select the type of catering</td></tr>
<tr><td colspan="2">Current Type: <input type="radio" name="type" checked="checked" value="<?php echo $cater['type'];?>" cclass="form-control add-todo" required> <?php echo $cater['type'];?></td></tr>
<tr><td><input type="radio" name="type" value="buffet" cclass="form-control add-todo" required> Buffet <img src="../images/catering/bf1.jpg" class="img-rounded" alt="Buffet" width="100" height="100"></td>
<td><input type="radio" name="type" value="platewise" cclass="form-control add-todo" required> Per plate<img src="../images/catering/plt3.jpg" class="img-rounded" alt="Plate of food" width="100" height="100"></td></tr>

<tr><td colspan="2"><em>Current Photo</em></td></tr>
<tr><td colspan="2"><img src="<?php echo '../'.$cater['image'];?>" class="img-rounded" alt="Current photo" width="100" height="100">
<input type="hidden" name="oldphoto" value="<?php echo $cater['image'];?>"></td></tr>
<tr><td colspan="2" style="font-weight:bold;">Upload a sample photo of the food (buffet or plate):</td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo"></td></tr>

<tr><td colspan="2" style="font-weight:bold;">Give a brief description of what constitutes your menu:</td></tr>
<tr><td colspan="2"><textarea name="menu" class="form-control add-todo" placeholder="Menu descrption e.g. Two proteins, two carbo..."/><?php echo $cater['menu'];?></textarea></td></tr>

<tr><td colspan="2" style="font-weight:bold;">Enter the amount you charge per unit - per plate/per person in buffet(KShs.):</td></tr>
<tr><td colspan="2"><input type="text" name="price" value="<?php echo $cater['price'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

<tr><td colspan="2">
<input type="submit" name="updateCat" class="btn btn-info btn-block" value="Update" id="submit"></td></tr>
</table>			
</form>
 <?php } //end of foreach
    ?>
 </div>
 <?php 
    } //end of get cat 
    ?>

<!--End of catering div -->

 <!--Equipment div-->
  <?php    if($_GET['svs'] == 'equip'){ //for editing equipment
?>
      <div class="panel panel-warning mydiv">
       <?php foreach ($equips as $equip){?>
	  <form action="editservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="eid" value="<?php echo $equip['eid'];?>" />
	  <table id="servicetbl">
<tr><td colspan="4" style="font-weight:bold;">Select the type of equipment you offer</td></tr>
<tr><td colspan="4">Current Type: <input type="radio" name="type" checked="checked" value="<?php echo $equip['type'];?>" cclass="form-control add-todo" required> <?php echo $equip['type'];?></td></tr>
<tr><td><input type="radio" name="type" value="Public Address" cclass="form-control add-todo" required> <img src="../images/equipment/pa1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Podium" cclass="form-control add-todo" required> <img src="../images/equipment/lectern1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Projector" cclass="form-control add-todo" required> <img src="../images/equipment/proj1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Flip Charts" cclass="form-control add-todo" required> <img src="../images/equipment/chart1.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><em>Current Photo</em></td></tr>
<tr><td><img src="<?php echo '../'.$equip['image'];?>" class="img-rounded" alt="Current photo" width="100" height="100">
<input type="hidden" name="oldphoto" value="<?php echo $equip['image'];?>"></td></tr>
<tr><td colspan="4" style="font-weight:bold;">Upload a photo of the equipment:</td></tr>
<tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo"></td></tr>

<tr><td colspan="4" style="font-weight:bold;">Enter the amount you charge for the selected equipment(KShs.):</td></tr>
<tr><td colspan="4"><input type="text" name="price" value="<?php echo $equip['price'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

<tr><td colspan="4">
<input type="submit" name="updateEquip" class="btn btn-info btn-block" value="Update" id="submit"></td></tr>
</table>		
</form>
 <?php } //end of foreach
    ?>
    </div>
  <?php 
    } //end of get equip ?>

<!--End of equipment div -->

<!--venues div-->
 <?php    if($_GET['svs'] == 'venue'){ //for editing venues
?>
      <div class="panel panel-info mydiv">
      <?php foreach ($venues as $venue){?>
	  <form action="editservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="vid" value="<?php echo $venue['vid'];?>" />
	  <table id="servicetbl">
       <tr><td colspan="2"><em>Current Photo</em></td></tr>
      <tr><td colspan="2"><img src="<?php echo '../'.$venue['image'];?>" class="img-rounded" alt="Current photo" width="100" height="100">
<input type="hidden" name="oldphoto" value="<?php echo $venue['image'];?>"></td></tr>
<tr><td colspan="2" style="font-weight:bold;">Upload a photo of the venue:</td></tr>
<tr><td colspan="2"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo"></td></tr>

<tr><td colspan="2" style="font-weight:bold;">Enter the total number of people that can be hosted in the venue:</td></tr>
<tr><td colspan="2"><input type="text" name="ppl" value="<?php echo $venue['people'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Number of people/guests" required/></td></tr>

<tr><td colspan="2" style="font-weight:bold;">Enter the amount you charge for the facility (KShs.):</td></tr>
<tr><td colspan="2"><input type="text" name="price" value="<?php echo $venue['price'];?>" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

<tr><td colspan="2">
<input type="submit" name="updateVenue" class="btn btn-info btn-block" value="Update" id="submit"></td></tr>
</table>		
</form>
 <?php } //end of foreach 
    ?>
 </div>
 <?php 
    } //end of get div?>

<!--End of venues div -->

 
  </div>
     
 <?php include("../includes/footer.php"); ?>
</div>

 <?php include("../includes/signlogin.php"); ?>



    <?php
} //end of edit
if($_GET['req'] == 'del'){ 
    //for files requiring deleting
if($_GET['svs'] == 'tent'){ //for deleting Tents
try { 
   $sql = "DELETE FROM tents WHERE tid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_GET['id']);
    $stmt->execute();
	
    //echo ("<script language='javascript'> window.alert('Tent Deleted Successfully')</script>");
    $_SESSION['success'] = "Tent Details Deleted Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}

if($_GET['svs'] == 'seat'){ //for deleting seats
try { 
   $sql = "DELETE FROM seats WHERE sid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_GET['id']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Seat Deleted Successfully')</script>");
    $_SESSION['success'] = "Seat Details Deleted Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

if($_GET['svs'] == 'cat'){ //for deleting catering
try {
   $sql = "DELETE FROM catering WHERE cid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_GET['id']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Catering Details Deleted Successfully')</script>");
    $_SESSION['success'] = "Catering Details Deleted Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

if($_GET['svs'] == 'equip'){ //for deleting equipment
try { 
   $sql = "DELETE FROM equipment WHERE eid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_GET['id']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Equipment Deleted Successfully')</script>");
    $_SESSION['success'] = "Equipment Details Deleted Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

if($_GET['svs'] == 'venue'){ //for deleting venues
try { 
   $sql = "DELETE FROM venues WHERE vid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_GET['id']);
    $stmt->execute();
	
    //echo ("<script language='javascript'> window.alert('Venue Deleted Successfully')</script>");
    $_SESSION['success'] = "Venue Details Deleted Successfully.";    
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}
 }//end of deletes
  }//end of if isset req


//Update services
//update tents
if(isset($_POST['updateTent'])){
    $photo = ''; $oldphoto = $_POST['oldphoto'];
    $photo = $oldphoto;
if($_FILES["image"]["size"] > 0){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/tents/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/tents/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];
            $photo = $location;
}

try { 
	 $size = $_POST['size'];
	 $price = $_POST['price']; $people = 0;
	 if($size == '20x30'){$people = 25;}
	 else if($size == '30x60'){$people = 150;}
	 else if($size == '40x60'){$people = 200;}
	 else{ $people = 300;}

   $sql = "UPDATE tents SET type =?, image=?, size=?, people=?, price=? WHERE tid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $photo);
	$stmt -> bindParam(3, $size);
	$stmt -> bindParam(4, $people);
	$stmt -> bindParam(5, $price);
	$stmt -> bindParam(6, $_POST['tid']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Tent Details Updated Successfully')</script>");
    $_SESSION['success'] = "Tent Details Updated Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}

//update seats 
if(isset($_POST['updateSeat'])){
 $photo = ''; $oldphoto = $_POST['oldphoto'];
    $photo = $oldphoto;
if($_FILES["image"]["size"] > 0){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/seats/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/seats/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];
            $photo = $location;
}

try { 

   $sql = "UPDATE seats SET type=?, image=?, quantity=?, price=? WHERE sid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $photo);
	$stmt -> bindParam(3, $_POST['qty']);
	$stmt -> bindParam(4, $_POST['price']);
	$stmt -> bindParam(5, $_POST['sid']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Seat Details Updated Successfully')</script>");
    $_SESSION['success'] = "Seat Details Updated Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//update catering 
if(isset($_POST['updateCat'])){
    $photo = ''; $oldphoto = $_POST['oldphoto'];
    $photo = $oldphoto;
if($_FILES["image"]["size"] > 0){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/catering/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/catering/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];
            $photo = $location;
}

try {
   $sql = "UPDATE catering SET type=?, image=?, menu=?, price=? WHERE cid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $photo);
	$stmt -> bindParam(3, $_POST['menu']);
	$stmt -> bindParam(4, $_POST['price']);
	$stmt -> bindParam(5, $_POST['cid']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Catering Details Updated Successfully')</script>");
    $_SESSION['success'] = "Catering Details Updated Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//update equipment
if(isset($_POST['updateEquip'])){
    $photo = ''; $oldphoto = $_POST['oldphoto'];
    $photo = $oldphoto;
if($_FILES["image"]["size"] > 0){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/equipment/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/equipment/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];
            $photo = $location;
}

try { 
   $sql = "UPDATE equipment SET type=?, image=?, price=? WHERE eid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $photo);
	$stmt -> bindParam(3, $_POST['price']);
	$stmt -> bindParam(4, $_POST['eid']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Equipment Details Updated Successfully')</script>");
    $_SESSION['success'] = "Equipment Details Updated Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//update venue
if(isset($_POST['updateVenue'])){
    $photo = ''; $oldphoto = $_POST['oldphoto'];
    $photo = $oldphoto;
if($_FILES["image"]["size"] > 0){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/venues/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/venues/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];
            $photo = $location;
}

try { 
   $sql = "UPDATE venues SET image=?, people=?, price=? WHERE vid=?";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $photo);
	$stmt -> bindParam(2, $_POST['ppl']);
	$stmt -> bindParam(3, $_POST['price']);
	$stmt -> bindParam(4, $_POST['vid']);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Venue Details Updated Successfully')</script>");
    $_SESSION['success'] = "Venue Details Updated Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

?>