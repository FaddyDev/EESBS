<?php if(session_status()==PHP_SESSION_NONE){
session_start();}
//error_reporting(0); ?>
<?php include("../includes/dbconn.php"); //Create db connenction first ?>
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
        
       <script>
function checkPasswordMatch01() {
    var submt = document.getElementById("submit1");
    var password = $("#pass01").val();
    var confirmPassword = $("#pass02").val();
	
    if(password == '' && confirmPassword == ''){ $("#divCheckPasswordMatch").html("");
        
    }
	else{
    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<font color='red'>Passwords do not match!</font>");
		}
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		}
		}
}


function checkPasswordMatch02() {
    var submt = document.getElementById("submit1");
    var password = $("#pass01").val();
    var confirmPassword = $("#pass02").val();
	
    if(password == '' && confirmPassword == ''){ $("#divCheckPasswordMatch").html("");
        
    }
	else{
    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<font color='red'>Passwords do not match!</font>");
		}
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		}
		}
}
function confirmPass() {
    var password = $("#pass01").val();
    var confirmPassword = $("#pass02").val();
	
	
    if(password == '' && confirmPassword == ''){ 
        return true;
    }
	else{
    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<font color='red'>Passwords do not match!</font>");
		return false}
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		return true;}
		}
}
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
<?php error_reporting(0); ?>
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
        <?php if(isset($_SESSION["is_logged"])){ if($_SESSION["role"] == 1){?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php } else{?>
          <li><a href="../admin.php">Admin</a></li>
            <li class="active"><a href="editprof.php">Update Profile</a></li>
        <?php }} ?>
        <li><a href="../services.php">Services</a></li>
        <li><a href="../order.php">Order</a></li>
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
  
<?php
//Edit Profile
if(isset($_POST['edit'])){
    $pass = '';
    $oldpass = $_POST['oldpass'];
    try {
    if(empty($_POST['password'])) {
        $pass = $oldpass;
    }
    else { 
        $hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $pass = $hashed_pass;
    }

  $sql = "UPDATE s_providers SET username=:username, password=:pass WHERE uid=:uid";
    // Prepare statement
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(":username", $_POST['username']);
    $stmt -> bindParam(":pass", $pass);
    $stmt -> bindParam(":uid", $_POST["uid"]);
    
    // execute the query
    $stmt->execute();
    $success = 'Profile updated successfully!';
    //return $success;
    }
catch(PDOException $e)
    {
    $fail = "Update failed: ".$sql . "<br>" . $e->getMessage();
    //return $fail;
     }

}
//else{

    $data = array();
try {   
    $sql = "SELECT * FROM s_providers TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
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

$conn = null; 
?>
 <!--edit prof div-->

<div class="mydiv">     
<?php if(isset($success)){
    echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span> '.$success.'</div>';
	}?> 
<?php if(isset($fail)){
    echo '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span> '.$fail.'</div>';
	}?> 

<form class="panel panel-default" role="form" action="editprof.php" onsubmit="return confirmPass();" class="form-group" method="post">
<input type="hidden" name="uid" value="<?php echo $_SESSION['uid'];?>"/>

<div class="form-group well well-sm">
<label for="username">Username</label>
<input type="text" name="username" value="<?php echo $data['username'];?>" class="form-control add-todo" id="log" placeholder="Provide a username" title="You'll need this username to sign in"/>
</div>

<input type="hidden" name="oldpass" value="<?php echo $data['password'];?>"/>
<div  class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span> 
There's an existing password, leave the password fields blank unless you wish to change the password!</div>
<div id="divCheckPasswordMatch"></div>
<div class="form-group well well-sm">
<label for="password">Password</label>
<input type="text" name="password" class="form-control add-todo" id="pass01" placeholder="Enter a password" onkeyup="checkPasswordMatch01();" />
</div>
<div class="form-group well well-sm">
<label for="password2">Re-Enter Password</label>
<input type="password" class="form-control add-todo" name="pass2" id="pass02" onkeyup="checkPasswordMatch02();" placeholder="Re-Enter the Password" />
</div>

<input type="submit" name="edit" class="btn btn-primary btn-block" value="Update Profile" id="submit1">			
</form>

</div>
 
<!--End of editprof div -->
<?php //} ?>
      	  
	  </div>
  <?php include("../includes/signlogin.php"); ?>   
 <?php include("../includes/footer.php"); ?>
</div>
</body>
</html>


