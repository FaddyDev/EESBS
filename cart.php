<?php if(session_status()==PHP_SESSION_NONE){
session_start();}  
if(isset($_POST['orderbtn'])){
  //SMS
  function sendsms($msg, $tophone){
    // Be sure to include the file you've just downloaded
require_once('includes/AfricasTalkingGateway.php');
// Specify your login credentials
$username   = "eesbs";
$apikey     = "9d0d0fe4fdf59c742eb3b11e67782281f42d4de41787f9db20cf56af327e0c6b";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = "+254".$tophone;
// And of course we want our recipients to know what we really do
$message    = $msg;
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
$success = true;
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
   // echo " Number: " .$result->number;
    //echo " Status: " .$result->status;
    //echo " MessageId: " .$result->messageId;
    //echo " Cost: "   .$result->cost."\n";
    $success = true;
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
  $success = false;
}
return $success;
}



  include("includes/dbconn.php");
      try {
    //Confirm payment first
    $payid = ''; $amount = 0; $bid = 0;
      $sql = "SELECT * FROM pesapi_payment TRY WHERE receipt = ?"; 
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_POST["tid"])))
	{  
  if($stmt->rowCount() == 0)
	{
    $stmt = null;
     //If there's no payment do not proceed
     $_SESSION['fail'] = "Payment not made. Please check the transaction id and retry.";
//echo "<meta http-equiv='refresh' content='0;url=order.php'> ";?>
<script>
window.location.href = 'order.php';
</script>
<?php
//exit;
//To add condition that if amount is made and is not full then something happens
	 }else{
     //if payment has been made proceed  
     //if payment has been made get the payid
    $row = $stmt -> fetch(PDO::FETCH_ASSOC);
    $payid = $row['receipt'];
    $amount = $row['amount'];
    $used = $row['used']; //include this field in pesapi_payment
    if($used == 1){      
     $_SESSION['fail'] = "Ooops! That transaction ID has already been used.";
//echo "<meta http-equiv='refresh' content='0;url=order.php'> "; ?>
<script>
window.location.href = 'order.php';
</script>
<?php
} else { //proceed

$items = 0; $amount = 0; $sp_phones = array();
foreach ($_SESSION["cart_item"] as $item){
//Increments
$items += 1;
$amount += $item['quantity'] * $item['price'];;
//get sp phones
$sql = "SELECT phone FROM s_providers WHERE uid =?";
$stmt = $conn->prepare($sql);
if($stmt->execute(array($item['uid'])))
{
$row = $stmt -> fetch(PDO::FETCH_ASSOC);
 if(!in_array($row['phone'], $sp_phones, true)){   
 array_push($sp_phones, $row['phone']);
 }
}  


//Fetch previous buyer id
$prevbid = 0; $newbid = 0;
      $sql = "SELECT * FROM orders WHERE bid = (SELECT MAX(bid) FROM orders)";
    $stmt = $conn->prepare($sql);
	if($stmt->execute())
	{
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	   $prevbid = $row['bid'];
	 }  
   $newbid = $prevbid+1;
   $bid = $newbid;
   $stmt = null;
   $date = date('d/m/Y h:i:s');
   
   $sql = "INSERT INTO orders (uid, itmid, bid, svstype, size, people, quantity, transact_id, oprice, address, phone, reqdate, date_time)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $item['uid']);
	$stmt -> bindParam(2, $item['id']);
	$stmt -> bindParam(3, $newbid);
	$stmt -> bindParam(4, $item['svstyp']);
  $stmt -> bindParam(5, $item['size']);
  $stmt -> bindParam(6, $item['people']);
	$stmt -> bindParam(7, $item['quantity']);
  $stmt -> bindParam(8, $payid);
	$stmt -> bindParam(9, $item['price']);
  $stmt -> bindParam(10, $_POST['address']);
	$stmt -> bindParam(11, $_POST['phone']);
  $stmt -> bindParam(12, $_POST['reqdate']);
  $stmt -> bindParam(13, $date);
  $stmt->execute(); //To update quantity later
 $stmt = null;

  //Insert into finances as well; to select items belonging to a specific provider
  $comm = 0.1; //Commission is 10%, changeable
  $totbf = $item['quantity'] * $item['price'];
  $com = $comm * $totbf;
  $totaft = $totbf - $com; //If commission is ever wanted, one can easily get the differences between totals before and after commission
  $sql = "INSERT INTO finances (uid, bid, tot_before, tot_after)
    VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
	$stmt -> bindParam(1, $item['uid']);
	$stmt -> bindParam(2, $bid);
	$stmt -> bindParam(3, $totbf, PDO::PARAM_INT);
    $stmt -> bindParam(4, $totaft, PDO::PARAM_INT);
    $stmt->execute(); //To update quantity later
    $stmt = null;
}
//Receipt used
$used = 1;
$sql = "UPDATE pesapi_payment SET used=? WHERE receipt=?";
$stmt = $conn->prepare($sql);
$stmt -> bindParam(1, $used);
$stmt -> bindParam(2, $payid);
$stmt->execute(); //To update quantity later
$stmt = null;
//To text both provider and customer...customer may download form
//To buyer
$msg = "EESBS Notification! You've sucessfully ordered ".$items." item(s) worth KShs. ".$amount.". Payment receipt: ".$payid.". Service provider(s) will contact you to discuss delivery.";
$tophone = $_POST['phone'];
sendsms($msg, $tophone);

//To providers
foreach($sp_phones as $phone){ 
$msg = "EESBS Notification! There's an order placed for your item(s). Kindly log in to your account ASAP to find out more."; //Link
sendsms($msg, $phone);
}

//For receipt;
$_SESSION['success'] = "Order placed successfully. Kindly await further communication and delivery.";
$_SESSION['dt'] = date('d/m/Y H:i');
$_SESSION['items'] = $_SESSION["cart_item"];
unset($_SESSION["cart_item"]);
//echo "<meta http-equiv='refresh' content='0;url=order.php'> ";?>
<script>
window.location.href = 'order.php';
</script>
<?php
}//end of pay not used
  }//End of if pay exists
   }
    }
catch(PDOException $e)
    {
    $fail = "Update failed: ".$sql . "<br>" . $e->getMessage();
    echo $fail;
     }

}else{
?>

<!--Shopping Cart modal-->
<!-- Modal -->
<div id="ModalCart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Shopping Cart</h4>
      </div>
      <div class="modal-body">

<div class="txt-heading"><a class="btn btn-warning btn-block" href="order.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1" class="table table-bordered">
<tbody>
<tr>
<th><strong>Service Type</strong></th>
<th><strong>Company Name</strong></th>
<th><strong>Size</strong></th>
<th><strong>People</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Price (KShs.)</strong></th>
<th><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
        <td><?php echo $item["svstyp"]; ?></td>
				<td><strong><?php echo $item["companyName"]; ?></strong></td>
				<td><?php echo $item["size"]; ?></td>
				<td><?php echo $item["people"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
				<td align=right><?php echo $item["price"]; ?></td>
				<td><a href="order.php?action=remove&code=<?php echo $item["code"]; ?>" class="btn btn-danger">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="7" style="text-align:right;" align=right><strong>Total:</strong> <?php echo "KShs. ".$item_total; ?></td>
</tr>
<tr><td colspan="7"><span class="text-info">To order, send <?php echo "KShs. ".$item_total; ?> via M-Pesa to 0711219260 (EESBS Paybill) then submit the transaction id</span></td></tr>
<form method="post" action="cart.php">
<tr>
<td colspan="2"><input type="text" class="form-control add-todo" placeholder="Transaction ID" name="tid" required></td>
<td colspan="3"><input type="text" class="form-control add-todo" placeholder="Physical Address" name="address" required></td>
<td colspan="2"><input type="text" class="form-control add-todo" placeholder="Phone Number" name="phone" onKeyPress="return numbersonly(event)" required></td>
</tr>
<tr>
<td colspan="5"><input type="text" class="form-control add-todo datepicker" placeholder="Date when you require the services" name="reqdate" onKeyDown="return false" required></td>
<td colspan="2" style="text-align:right;" align=right><input type="submit" class="btn btn-primary" style="float: center;" value="Order" name="orderbtn" /></td>
</tr>
</form>
</tbody>
</table>		
  <?php
}
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--End Shopping Cart modal -->
<?php } ?>