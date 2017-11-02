<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 

if(isset($_GET['req'])){
	try { 
		$active = 0;
		if($_GET['req'] == 'act'){$active = 1;}
		else {$active = 0;}
 
		$sql = "UPDATE s_providers SET active =? WHERE uid=?";
		 $stmt = $conn->prepare($sql);
	 $stmt -> bindParam(1, $active);
	 $stmt -> bindParam(2, $_GET['uid']);
		 $stmt->execute();
	 
	 //echo ("<script language='javascript'> window.alert('xxx')</script>");
	 if($_GET['req'] == 'act'){$_SESSION['success'] = "Service provider activated sucessfully!";}
	 else {$_SESSION['success'] = "Service provider deactivated sucessfully!";}
 //echo "<meta http-equiv='refresh' content='0;url=../admin.php'> ";?>
<script>
window.location.href = '../admin.php';
</script>
<?php
	 
		 }
 catch(PDOException $e)
		 {
		 echo $sql . "<br>" . $e->getMessage();
		 }
$stmt = null;
}


else{
$providers = array(); 
try { 
//$sql = "SELECT * FROM orders JOIN tents on orders.itmid = tents.tid WHERE orders.svstype='Tent'"; //WHERE uid = ".$_SESSION["uid"]." 
$sql = "SELECT * FROM s_providers WHERE role=1";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	 while($row = $stmt -> fetch())
	 {
	   $providers[] = $row;
	 }
	} 
	
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>
 
    <h3 style="text-align:center">Service Providers</h3>
	  <div class="panel table-responsive tents panel-primary" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <!--<h4 class="bg-primary"><center>Service Providers</center></h4>-->
	  	   <table class="table table-striped table-hover table-bordered table-condensed" id="financetable">
		<thead>
          <tr>
            <th>Logo</th>
			      <th>Name</th>
            <th>Location</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Till</th>
						<th>Action</th>
          </tr>
		  </thead>
		  <tbody>
		  <?php foreach ($providers as $prov){?>
		  <tr>
		  <td><img src="<?php echo $prov['logo'];?>" class="img-rounded" alt="" width="100" height="100"></td>
          <td><?php echo $prov['companyName'];?></td>
          <td><?php echo $prov['c_location'];?></td>
		  <td><?php echo $prov['email'];?></td>
		  <td><?php echo $prov['phone'];?></td>
          <td><?php echo $prov['till'];?></td>
			<td><?php if($prov['active'] == 0){?> <a href="admin/providers.php?req=act&uid=<?php echo $prov['uid'];?>" class="btn btn-xs btn-info">Activate</a> <?php }
			else{?> <a href="admin/providers.php?req=deact&uid=<?php echo $prov['uid'];?>" class="btn btn-xs btn-danger">Deactivate</a> <?php }?></td>
          </tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
			<?php } ?>