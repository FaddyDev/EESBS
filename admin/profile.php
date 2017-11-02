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
 <p> <span class="glyphicon glyphicon-user"></span> <b>Username:</b> <?php echo $data['username'];?></p> 
	<p> <a href="admin/editprof.php" class="btn btn-xs btn-primary">Edit Profile</a></p>
  </div>