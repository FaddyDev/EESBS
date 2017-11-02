<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 

$messages = array(); 
try {
	$sql = "SELECT * FROM messages WHERE uid=?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION['uid'])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $messages[] = $row;
	 }
	} 
	
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>
 
    <h3 style="text-align:center">Messages</h3>
	  <div class="panel table-responsive tents panel-primary" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <!--<h4 class="bg-primary"><center>Service Providers</center></h4>-->
	  	   <table class="table table-striped table-hover table-bordered table-condensed" id="financetable">
		<thead>
          <tr>
            <th>Message</th>
			<th>Phone</th>
			<th>Date</th>
            <th>Response</th>
			<th>Action</th>
          </tr>
		  </thead>
		  <tbody>
		  <?php foreach ($messages as $msg){?>
		  <tr>
          <td><?php echo $msg['message'];?></td>
          <td><?php echo '0'.$msg['phone'];?></td>
          <td><?php echo $msg['reg_date'];?></td>
		  <td><?php echo $msg['response'];?></td>
			<td><?php if($msg['replied'] == 0){?> <a href="response.php?id=<?php echo $msg['id'];?>" class="btn btn-xs btn-info">Reply</a> <?php }?></td>
          </tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>