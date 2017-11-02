<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
<?php include("../includes/dbconn.php"); //DB 
if(!(isset($_POST['tents']) || isset($_POST['seats']) || isset($_POST['catering']) || isset($_POST['equipment']) || isset($_POST['venues']))){
?>
  <script type="text/javascript">
    $(document).ready(
  function(){$('.others').hide();
  });
</script>
<p><label>Add Services:</label> <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalTents">Tents <span class="glyphicon glyphicon-plus"></span></button>
  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalSeats">Seats <span class="glyphicon glyphicon-plus"></span></button>
  <button class="btn btn-sm btn-sucess" data-toggle="modal" data-target="#ModalCatering">Catering <span class="glyphicon glyphicon-plus"></span></button>
  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalEquipment">Equipment <span class="glyphicon glyphicon-plus"></span></button>
  <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalVenues">Venues <span class="glyphicon glyphicon-plus"></span></button></p>
  
  <!--Tents modal-->
<!-- Modal -->
<div id="ModalTents" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Tent</h4>
      </div>
      <div class="modal-body">
	  <form action="SProvider/myservices.php" class="form-group" method="post" name="tentsform" onsubmit="return select1();" enctype="multipart/form-data">
	  <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"];?>" />
	  <table id="servicetbl">
<tr><td colspan="4"><label>Select the type of tent:</label></td></tr>
<tr><td><input type="radio" name="type" value="typeA" cclass="form-control add-todo" required> <img src="images/tents/1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeB" cclass="form-control add-todo" required> <img src="images/tents/2.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeC" cclass="form-control add-todo" required> <img src="images/tents/3.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeD" cclass="form-control add-todo" required> <img src="images/tents/4.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><label>Upload a photo of your tent:</label></td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" required></td></tr>
<tr><td colspan="4"><label>Select the available sizes of the tent and the prices/charges for each (KShs.):</label></td></tr>
<tr><td colspan="2" class="form-control">20x30 <input type="checkbox" name="tent[]" checked="checked" value="20x30" id="chkprice1" onchange="return showHideprice1()"></td>
<td colspan="2"><input type="text" name="20by30price" class="form-control add-todo" id="price1" onKeyPress="return numbersonly(event)" placeholder="Price of 20x30 tent"/></td></tr>

<tr><td colspan="2" class="form-control">30x60 <input type="checkbox" name="tent[]" value="30x60" id="chkprice2" onchange="return showHideprice2()"></td>
<td colspan="2"><input type="text" name="30by60price" class="form-control add-todo others" id="price2" onKeyPress="return numbersonly(event)" placeholder="Price of 30x60 tent"/></td></tr>

<tr><td colspan="2" class="form-control">40x60 <input type="checkbox" name="tent[]" value="40x60" id="chkprice3" onchange="return showHideprice3()"></td>
<td colspan="2"><input type="text" name="40by60price" class="form-control add-todo others" id="price3" onKeyPress="return numbersonly(event)" placeholder="Price of 40x60 tent" /></td></tr>

<tr><td colspan="2" class="form-control">40x90 <input type="checkbox" name="tent[]" value="40x90" id="chkprice4" onchange="return showHideprice4()"></td>
<td colspan="2"><input type="text" name="40by90price" class="form-control add-todo others" id="price4" onKeyPress="return numbersonly(event)" placeholder="Price of 40x90 tent"/></td></tr>
</table>
<input type="reset" class="btn btn-xs btn-danger" style="float: left;" value="Clear Fields">
<input type="submit" name="tents" class="btn btn-xs btn-info" style="float: right;" value="Save" id="submit">			
</form>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of tents modal -->

  <!--Seats modal-->
<!-- Modal -->
<div id="ModalSeats" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Seats</h4>
      </div>
      <div class="modal-body">
	  <form action="SProvider/myservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"];?>" />
	  <table id="servicetbl">
<tr><td colspan="4"><label>Select the type of seat:</label></td></tr>
<tr><td><input type="radio" name="type" value="typeA" cclass="form-control add-todo" required> <img src="images/seats/1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeB" cclass="form-control add-todo" required> <img src="images/seats/2.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeC" cclass="form-control add-todo" required> <img src="images/seats/3.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="typeD" cclass="form-control add-todo" required> <img src="images/seats/4.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><label>Upload a photo of the seat:</label></td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" required></td></tr>
<tr><td colspan="4"><label>Enter the number of seats available:</label></td></tr>
<tr><td colspan="4"><input type="text" name="qty" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Quantity" required/></td></tr>

<tr><td colspan="4"><label>Enter the amount you charge for each seat of the selected type(KShs.):</label></td></tr>
<tr><td colspan="4"><input type="text" name="price" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

</table>
<input type="reset" class="btn btn-xs btn-danger" style="float: left;" value="Clear Fields">
<input type="submit" name="seats" class="btn btn-xs btn-info" style="float: right;" value="Save" id="submit">			
</form>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of seats modal -->

 <!--catering modal-->
<!-- Modal -->
<div id="ModalCatering" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Catering</h4>
      </div>
      <div class="modal-body">
	  <form action="SProvider/myservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"];?>" />
	  <table id="servicetbl">
<tr><td colspan="2"><label>Select the type of catering:</label></td></tr>
<tr><td><input type="radio" name="type" value="buffet" cclass="form-control add-todo" required> Buffet <img src="images/catering/bf1.jpg" class="img-rounded" alt="Buffet" width="100" height="100"></td>
<td><input type="radio" name="type" value="platewise" cclass="form-control add-todo" required> Per plate<img src="images/catering/plt3.jpg" class="img-rounded" alt="Plate of food" width="100" height="100"></td></tr>

<tr><td colspan="2"><label>Upload a sample photo of the food (buffet or plate):</label></td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" required></td></tr>
<tr><td colspan="2"><label>Give a brief description of what constitutes your menu:</label></td></tr>
<tr><td colspan="2"><textarea name="menu" class="form-control add-todo" placeholder="Menu descrption e.g. Two proteins, two carbo..." required/></textarea></td></tr>

<tr><td colspan="2"><label>Enter the amount you charge per unit - per plate/per person in buffet(KShs.):</label></td></tr>
<tr><td colspan="2"><input type="text" name="price" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

</table>
<input type="reset" class="btn btn-xs btn-danger" style="float: left;" value="Clear Fields">
<input type="submit" name="catering" class="btn btn-xs btn-info" style="float: right;" value="Save" id="submit">			
</form>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of catering modal -->

 <!--Equipment modal-->
<!-- Modal -->
<div id="ModalEquipment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Equipment</h4>
      </div>
      <div class="modal-body">
	  <form action="SProvider/myservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"];?>" />
	  <table id="servicetbl">
<tr><td colspan="4"><label>Select the type of equipment you offer:</label></td></tr>
<tr><td><input type="radio" name="type" value="Public Address" cclass="form-control add-todo" required> <img src="images/equipment/pa1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Podium" cclass="form-control add-todo" required> <img src="images/equipment/lectern1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Projector" cclass="form-control add-todo" required> <img src="images/equipment/proj1.jpg" class="img-rounded" alt="" width="100" height="100"></td>
<td><input type="radio" name="type" value="Flip Charts" cclass="form-control add-todo" required> <img src="images/equipment/chart1.jpg" class="img-rounded" alt="" width="100" height="100"></td></tr>

<tr><td colspan="4"><label>Upload a photo of the equipment:</label></td></tr><tr><td colspan="4"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" required></td></tr>

<tr><td colspan="4"><label>Enter the amount you charge for the selected equipment(KShs.):</label></td></tr>
<tr><td colspan="4"><input type="text" name="price" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

</table>
<input type="reset" class="btn btn-xs btn-danger" style="float: left;" value="Clear Fields">
<input type="submit" name="equipment" class="btn btn-xs btn-info" style="float: right;" value="Save" id="submit">			
</form>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of equipment modal -->

<!--venues modal-->
<!-- Modal -->
<div id="ModalVenues" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Conference Venue</h4>
      </div>
      <div class="modal-body">
	  <form action="SProvider/myservices.php" class="form-group" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="uid" value="<?php echo $_SESSION["uid"];?>" />
	  <table id="servicetbl">
<tr><td colspan="2"><label>Upload a photo of the venue:</label></td></tr><tr><td colspan="2"><input type="file" name="image" accept="image/jpeg,image/x-png" class="form-control add-todo" required></td></tr>

<tr><td colspan="2"><label>Enter the total number of people that can be hosted in the venue:</label></td></tr>
<tr><td colspan="2"><input type="text" name="ppl" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Number of people/guests" required/></td></tr>

<tr><td colspan="2"><label>Enter the amount you charge for the facility (KShs.):</label></td></tr>
<tr><td colspan="2"><input type="text" name="price" class="form-control add-todo" onKeyPress="return numbersonly(event)" placeholder="Price" required/></td></tr>

</table>
<input type="reset" class="btn btn-xs btn-danger" style="float: left;" value="Clear Fields">
<input type="submit" name="venues" class="btn btn-xs btn-info" style="float: right;" value="Save" id="submit">			
</form>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End of venues modal -->
  
 <?php 
$tents = array(); $equips = array(); $caters = array(); $venues = array(); $seats = array();
try { 
 //Tents
  $sql = "SELECT * FROM tents TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $tents[] = $row;
	 }
	} 
	
	 //Equipment
  $sql = "SELECT * FROM equipment TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $equips[] = $row;
	 }
	} 
	
	//Venues
  $sql = "SELECT * FROM venues TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $venues[] = $row;
	 }
	} 
	
	//Seats
  $sql = "SELECT * FROM seats TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $seats[] = $row;
	 }
	} 
	
	 //Catering
  $sql = "SELECT * FROM catering TRY WHERE uid = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_SESSION["uid"])))
	{
	 while($row = $stmt -> fetch())
	 {
	   $caters[] = $row;
	 }
	} 
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$stmt = null;
 ?>
 
    <h3>Current Services</h3>
     <!-- Tents division -->
	  <!--<p><a><span class="glyphicon glyphicon-minus" id="tentsign"></span></a></p>-->
	  <div class="panel table-responsive tents panel-primary" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-primary"><center>Tents</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="tentstable">
		<thead>
          <tr>
            <th>Image</th>
			<th>Size</th>
            <th>People(#)</th>
            <th>Charges</th>
						<th colspan="2">Action</th>
          </tr>
		  </thead>
		 
		  <tbody>
		  <?php foreach ($tents as $tent){?>
		  <tr><td><img src="<?php echo $tent['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $tent['size'];?></td>
		  <td><?php echo $tent['people'];?></td>
		  <td><?php echo $tent['price'];?></td>
			<td><a href="SProvider/editservices.php?req=edit&svs=tent&id=<?php echo $tent['tid'];?>" class="btn btn-xs btn-info">Edit</a></td>
			<td><a href="SProvider/editservices.php?req=del&svs=tent&id=<?php echo $tent['tid'];?>" class="btn btn-xs btn-danger">Delete</a></td>
			</tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	    	  <!-- Seats division -->
	  <!--<p><a><span class="glyphicon glyphicon-plus" id="seatsign"></span></a></p>-->
	  <div class="panel table-responsive panel-success seats" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-success"><center>Seats</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="seatstable">
		<thead>
          <tr>
            <th>Image</th>
			<th>Quantity</th>
            <th>Charges</th>
						<th colspan="2">Action</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($seats as $seat){?>
		  <tr><td><img src="<?php echo $seat['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $seat['quantity'];?></td>
		  <td><?php echo $seat['price'];?></td>
			<td><a href="SProvider/editservices.php?req=edit&svs=seat&id=<?php echo $seat['sid'];?>" class="btn btn-xs btn-info">Edit</a></td>
			<td><a href="SProvider/editservices.php?req=del&svs=seat&id=<?php echo $seat['sid'];?>" class="btn btn-xs btn-danger">Delete</a></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	  	  <!-- Equipment division -->
	  <!--<p><a><span class="glyphicon glyphicon-plus" id="equipsign"></span></a></p>-->
	  <div class="panel table-responsive panel-warning equips" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-warning"><center>Equipment</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="equiptable">
		<thead>
          <tr>
		    <th>Type</th>
            <th>Image</th>
            <th>Charges</th>
						<th colspan="2">Action</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($equips as $equip){?>
		  <tr><td><?php echo $equip['type'];?></td>
		  <td><img src="<?php echo $equip['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $equip['price'];?></td>
			<td><a href="SProvider/editservices.php?req=edit&svs=equip&id=<?php echo $equip['eid'];?>" class="btn btn-xs btn-info">Edit</a></td>
			<td><a href="SProvider/editservices.php?req=del&svs=equip&id=<?php echo $equip['eid'];?>" class="btn btn-xs btn-danger">Delete</a></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	  
	 	  <!-- Catering division -->
	  <!--<p><a><span class="glyphicon glyphicon-plus" id="catsign"></span></a></p>-->
	  <div class="panel table-responsive panel-danger cater" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-danger"><center>Catering</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="catertable">
		<thead>
          <tr>
		    <th>Type</th>
            <th>Image</th>
			<th>Menu</th>
            <th>Charges</th>
						<th colspan="2">Action</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($caters as $cater){?>
		  <tr><td><?php echo $cater['type'];?></td>
		  <td><img src="<?php echo $cater['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $cater['menu'];?></td>
		  <td><?php echo $cater['price'];?></td>
			<td><a href="SProvider/editservices.php?req=edit&svs=cat&id=<?php echo $cater['cid'];?>" class="btn btn-xs btn-info">Edit</a></td>
			<td><a href="SProvider/editservices.php?req=del&svs=cat&id=<?php echo $cater['cid'];?>" class="btn btn-xs btn-danger">Delete</a></td></tr>
		  <?php }?>
		  </tbody>
        </table>
	  </div>
	  
	    	  <!-- Venues division -->
	  <!--<p><a><span class="glyphicon glyphicon-plus" id="venuesign"></span></a></p>-->
	  <div class="panel table-responsive panel-info venue" sstyle="background-color:#F5F4F1; border-radius:5px;">
	  <h4 class="bg-info"><center>Conference venues</center></h4>
	  	   <table   class="table table-striped table-hover table-bordered table-condensed" id="venuetable">
		<thead>
          <tr>
            <th>Image</th>
			<th>People (#)</th>
            <th>Charges</th>
						<th colspan="2">Action</th>
          </tr>
		  </thead>
		  
		  <tbody>
		  <?php foreach ($venues as $venue){?>
		  <td><img src="<?php echo $venue['image'];?>" class="img-rounded" alt="" width="100" height="100"></td>
		  <td><?php echo $venue['people'];?></td>
		  <td><?php echo $venue['price'];?></td>
			<td><a href="SProvider/editservices.php?req=edit&svs=venue&id=<?php echo $venue['vid'];?>" class="btn btn-xs btn-info">Edit</a></td>
			<td><a href="SProvider/editservices.php?req=del&svs=venue&id=<?php echo $venue['vid'];?>" class="btn btn-xs btn-danger">Delete</a></td></tr>
		  <?php }?>
		  </tbody>
        </table>
  </div>
<script type="text/javascript">
   //Show/Hide input fields	
	$("#chkprice1").click(function(){
	
        $("#price1").slideToggle("slow");
    });
	
	$("#chkprice2").click(function(){
	
        $("#price2").slideToggle("slow");
    });
	
	$("#chkprice3").click(function(){
	
        $("#price3").slideToggle("slow");
    });
	
		$("#chkprice4").click(function(){
	
        $("#price4").slideToggle("slow");
    });
	
	
 
	 function select1(){
	 var prc1 = document.getElementById("price1").value;
	 var prc2 = document.getElementById("price2").value;
	 var prc3 = document.getElementById("price3").value;
	 var prc4 = document.getElementById("price4").value;
	 
     if((prc1 || prc2 || prc3 || prc4) == ''){
	  alert('You MUST enter the price (Charges) for each selected tent size!');
		 return false;
		 }
		 //Add code here to enforce at least one selection
	else{
	 return true;}
	 }
	</script>



    <?php
}
//Insert services
//Insert tents
if(isset($_POST['tents'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/tents/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/tents/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];

try { 
	 $code = 0; $prevtid = 0;
       //Fetch previous id to set tent code for use in shopping cart
		 $sql = "SELECT * FROM tents WHERE tid = (SELECT MAX(tid) FROM tents)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevtid = $row['tid'];
	 }  
	 $code = 't'.($prevtid+1);
    
 $item_idCount = count($_POST['tent']);
        for($i=0; $i<$item_idCount; $i++) {
	 $size = $_POST['tent'][$i];
	 $price = 0; $people = 0;
	 if($size == '20x30'){$price = $_POST['20by30price']; $people = 25;}
	 else if($size == '30x60'){$price = $_POST['30by60price']; $people = 150;}
	 else if($size == '40x60'){$price = $_POST['40by60price']; $people = 200;}
	 else{$price = $_POST['40by90price']; $people = 300;}

   $sql = "INSERT INTO tents (type, image, size, people, price, uid, code)
    VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $location);
	$stmt -> bindParam(3, $size);
	$stmt -> bindParam(4, $people);
	$stmt -> bindParam(5, $price);
	$stmt -> bindParam(6, $_POST['uid']);
	$stmt -> bindParam(7, $code);
    $stmt->execute();
	}//End of checkbox loop
	
	//echo ("<script language='javascript'> window.alert('Tent Details Added Successfully')</script>");
	$_SESSION['success'] = "Tent Details Added Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php#services'> ";?>
<script>
window.location.href = '../dashboard.php#services';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

//Insert seats 
else if(isset($_POST['seats'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/seats/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/seats/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];

try { 
	 $code = 0; $prevtid = 0;
       //Fetch previous id to set tent code for use in shopping cart
		 $sql = "SELECT * FROM seats WHERE sid = (SELECT MAX(sid) FROM seats)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevtid = $row['sid'];
	 }  
	 $code = 's'.($prevtid+1);

   $sql = "INSERT INTO seats (type, image, quantity, price, uid, code)
    VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $location);
	$stmt -> bindParam(3, $_POST['qty']);
	$stmt -> bindParam(4, $_POST['price']);
	$stmt -> bindParam(5, $_POST['uid']);
	$stmt -> bindParam(6, $code);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Seat Details Added Successfully')</script>");
	$_SESSION['success'] = "Seat Details Added Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php#services'> ";?>
<script>
window.location.href = '../dashboard.php#services';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//Insert catering if(isset($_POST['tents'])){ else if(isset($_POST['seats'])){ else if(isset($_POST['catering'])){
else if(isset($_POST['catering'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/catering/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/catering/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];

try { 
	 $code = 0; $prevtid = 0;
       //Fetch previous id to set tent code for use in shopping cart
		 $sql = "SELECT * FROM catering WHERE cid = (SELECT MAX(cid) FROM catering)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevtid = $row['cid'];
	 }  
	 $code = 'c'.($prevtid+1);

   $sql = "INSERT INTO catering (type, image, menu, price, uid, code)
    VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $location);
	$stmt -> bindParam(3, $_POST['menu']);
	$stmt -> bindParam(4, $_POST['price']);
	$stmt -> bindParam(5, $_POST['uid']);
	$stmt -> bindParam(6, $code);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Catering Details Added Successfully')</script>");
	$_SESSION['success'] = "Catering Details Added Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php#services'> ";?>
<script>
window.location.href = '../dashboard.php#services';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//Insert equipment
else if(isset($_POST['equipment'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/equipment/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/equipment/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];

try { 
	 $code = 0; $prevtid = 0;
       //Fetch previous id to set tent code for use in shopping cart
		 $sql = "SELECT * FROM equipment WHERE eid = (SELECT MAX(eid) FROM equipment)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevtid = $row['eid'];
	 }  
	 $code = 'e'.($prevtid+1);

   $sql = "INSERT INTO equipment (type, image, price, uid, code)
    VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $_POST['type']);
	$stmt -> bindParam(2, $location);
	$stmt -> bindParam(3, $_POST['price']);
	$stmt -> bindParam(4, $_POST['uid']);
	$stmt -> bindParam(5, $code);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Equipment Details Added Successfully')</script>");
	$_SESSION['success'] = "Equipment Details Added Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php#services'> ";?>
<script>
window.location.href = '../dashboard.php#services';
</script>
<?php
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
$conn = null;
}

//Insert venue
else if(isset($_POST['venues'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"../images/venues/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"]);
			
			$location="images/venues/uploads/" . date('dmYhi').'_'.$_FILES["image"]["name"];

try { 
	 $code = 0; $prevtid = 0;
       //Fetch previous id to set tent code for use in shopping cart
		 $sql = "SELECT * FROM venues WHERE vid = (SELECT MAX(vid) FROM venues)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevtid = $row['vid'];
	 }  
	 $code = 'v'.($prevtid+1);

   $sql = "INSERT INTO venues (image, people, price, uid, code)
    VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $location);
	$stmt -> bindParam(2, $_POST['ppl']);
	$stmt -> bindParam(3, $_POST['price']);
	$stmt -> bindParam(4, $_POST['uid']);
	$stmt -> bindParam(5, $code);
    $stmt->execute();
	
	//echo ("<script language='javascript'> window.alert('Venue Details Added Successfully')</script>");
	$_SESSION['success'] = "Venue Details Added Successfully.";
//echo "<meta http-equiv='refresh' content='0;url=../dashboard.php#services'> ";?>
<script>
window.location.href = '../dashboard.php#services';
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