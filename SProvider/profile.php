<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB
$data = array();
try {    $sql = "SELECT * FROM s_providers TRY WHERE uid = ?";
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

 ?>
<div idd="prof" cclass="tab-pane fade in active">
 <h3>My Profile</h3>
	<p><?php if($data['logo']){?> <img src="<?php echo $data['logo']; ?>" class="img-circle" height="100px" width="100px" alt="<?php echo $data['companyName'].' logo';?>" /><?php }
	 else{ ?> <span class="glyphicon glyphicon-user"></span> <a href="SProvider/editprof.php" class="btn btn-primary btn-xs">Add Logo</a> <?php }?></p>
    <p> <span class="glyphicon glyphicon-user"></span> <b>Name:</b> <?php echo $data['companyName'];?></p> 
	<p> <span class="glyphicon glyphicon-map-marker"></span> <b>Location:</b> <?php echo $data['c_location'];?></p>
	<p> <span class="glyphicon glyphicon-envelope"></span> <b>Email:</b> <?php echo $data['email'];?></p>
	<p> <span class="glyphicon glyphicon-phone-alt"></span> <b>Phone:</b> <?php echo $data['phone'];?></p>
	<p> <span class="glyphicon glyphicon-pencil"></span> <b>Till #:</b> <?php echo $data['till'];?></p> 
	<p> <a href="SProvider/editprof.php" class="btn btn-xs btn-primary">Edit Profile</a></p>
  </div>