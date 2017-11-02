<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 

$finances = array(); 
try { 
//$sql = "SELECT * FROM orders JOIN tents on orders.itmid = tents.tid WHERE orders.svstype='Tent'"; //WHERE uid = ".$_SESSION["uid"]." 
$sql = "SELECT * FROM finances JOIN orders ON orders.bid=finances.bid WHERE finances.uid = ?  ORDER BY finances.fnid DESC";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $finances[] = $row;
	 }
	} 
	
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>
 
    <h3>My Finances</h3>
     <!-- Tents division -->
	  <!--<p><a><span class="glyphicon glyphicon-minus" id="tentsign"></span></a></p>-->
	  <div class="panel table-responsive tents panel-primary" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-primary"><center>Money Made</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="financetable">
		<thead>
          <tr>
            <th>Order Date</th>
			<th>Total Before Commission (Kshs.)</th>
            <th>Commission (Kshs.)</th>
            <th>After Commission (Kshs.)</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($finances as $fin){?>
		  <tr>
		  <td><?php echo $fin['date_time'];?></td>
          <td><?php echo $fin['tot_before'];?></td>
          <td><?php echo ($fin['tot_before'] - $fin['tot_after']);?></td>
		  <td><?php echo $fin['tot_after'];?></td>
          </tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
