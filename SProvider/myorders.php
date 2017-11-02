<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 

$orders = array(); 
try { 

//$sql = "SELECT * FROM orders JOIN tents on orders.itmid = tents.tid WHERE orders.svstype='Tent'"; //WHERE uid = ".$_SESSION["uid"]." 
$sql = "SELECT * FROM orders WHERE uid = ? ORDER BY orid DESC";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $orders[] = $row;
	 }
	} 
	
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>
 
    <h3>My Orders</h3>
     <!-- Tents division -->
	  <!--<p><a><span class="glyphicon glyphicon-minus" id="tentsign"></span></a></p>-->
	  <div class="panel table-responsive tents panel-primary" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-primary"><center>Orders for my services</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="orderstable">
		<thead>
          <tr>
            <th>Item</th>
			<th>Size</th>
            <th>People(#)</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Date Placed</th>
			<th>Date Required</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($orders as $order){?>
		  <tr>
          <td><?php echo $order['svstype'];?></td>
		  <td><?php echo $order['size'];?></td>
		  <td><?php echo $order['people'];?></td>
		  <td><?php echo $order['quantity'];?></td>
          <td><?php echo $order['oprice'];?></td>
		  <td><?php echo $order['address'];?></td>
		  <td><?php echo $order['phone'];?></td>
		  <td><?php echo $order['date_time'];?></td>
		  <td><?php echo $order['reqdate'];?></td>
          </tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
