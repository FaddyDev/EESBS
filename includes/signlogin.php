<?php if(session_status()==PHP_SESSION_NONE){
session_start();} ?>
 <script>
function checkPasswordMatch1() {
    var submt = document.getElementById("submit1");
    var password = $("#pass").val();
    var confirmPassword = $("#pass2").val();
	
	if(confirmPassword == ''){ $("#divCheckPasswordMatch").html("");
		submt.style.display = 'none';}
	else{
    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<font color='red'>Passwords do not match!</font>");
		submt.style.display = 'none';}
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		submt.style.display = 'block';}
		}
}


function checkPasswordMatch() {
    var submt = document.getElementById("submit1");
    var password = $("#pass").val();
    var confirmPassword = $("#pass2").val();
	
	if(password == ''){ $("#divCheckPasswordMatch").html("");
		submt.style.display = 'none';}
	else{
    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("<font color='red'>Passwords do not match!</font>");
		submt.style.display = 'none';}
    else{
        $("#divCheckPasswordMatch").html("Passwords match.");
		submt.style.display = 'block';}
		}
}
  </script>
  
  <?php include("dbconn.php"); //Establish connection to db ?>
<?php
//Sign up
if(isset($_POST['sign'])){

$hashed_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

try { 
  $sql = "SELECT * FROM s_providers TRY WHERE username = ?";
  $stmt = $conn->prepare($sql);
if($stmt->execute(array($_POST['username'])))
{
if($stmt->rowCount() > 0){  
  //echo ("<script language='javascript'> window.alert('Username exists, kindly repeat the sign up process with another username')</script>");
    //echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";?>
    <script>
    window.location.href = '../index.php';
    </script>
    <?php
}else{
  
    $role = $active = 1; 
    $sql = "INSERT INTO s_providers (companyName, c_location, email, phone, till, username, password, role, active)
    VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
	  $stmt -> bindParam(1, $_POST['cname']);
	  $stmt -> bindParam(2, $_POST['loc']);
	  $stmt -> bindParam(3, $_POST['email']);
	  $stmt -> bindParam(4, $_POST['phone']);
	  $stmt -> bindParam(5, $_POST['till']);
	  $stmt -> bindParam(6, $_POST['username']);
	  $stmt -> bindParam(7, $hashed_pass);
	  $stmt -> bindParam(8, $role);
	  $stmt -> bindParam(9, $active);
    $stmt->execute();
    echo ("<script language='javascript'> window.alert('Sign up successful, use the username and password to log in.')</script>");
    //echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";  
    $_SESSION['success'] = "Sign up successful, use the username and password to log in.";?>
<script>
window.location.href = '../index.php';
</script>
<?php
    }
  }
  else{//echo ("<script language='javascript'> window.alert('Ooops! There was an error. Please try again')</script>");
    //echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";    
    $_SESSION['fail'] = "Ooops! There was an error. Please try again.";
  }?>
  <script>
  window.location.href = '../index.php';
  </script>
  <?php
    }    
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

else if(isset($_POST['login'])){


try {    $sql = "SELECT * FROM s_providers TRY WHERE username = ?";
    $stmt = $conn->prepare($sql);
	if($stmt->execute(array($_POST['username'])))
	{
  if($stmt->rowCount() > 0){
	 while($row = $stmt -> fetch())
	 {
	  if(password_verify($_POST['password'],$row['password']) == 1)
	   {
       if($row['active'] == 0){
        $_SESSION['fail'] = "Account deactivated, please contact the admin.";
        echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";
       }else{
	    $_SESSION['is_logged'] = true;
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['username'] = $_POST['username'];
     if($row['role'] == 1){//header("Location: ../dashboard.php");
      //echo "<meta http-equiv='refresh' content='0;url=../dashboard.php'> ";?>
<script>
window.location.href = '../dashboard.php';
</script>
<?php
    } else{?>
      <script>
      window.location.href = '../admin.php';
      </script>
      <?php
      //header("Location: ../admin.php");
      //echo "<meta http-equiv='refresh' content='0;url=../admin.php'> ";
    }
    }
	   }
    else{//echo ("<script language='javascript'> window.alert('Login failed, check password then try again')</script>");
      $_SESSION['fail'] = "Login failed, check password then try again";?>
      <script>
      window.location.href = '../index.php';
      </script>
      <?php
      //echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";
    }
   }
  }
  else{ 
//echo ("<script language='javascript'> window.alert('Login failed, check username then try again')</script>");
$_SESSION['fail'] = "Login failed, check username then try again";?>
<script>
window.location.href = '../index.php';
</script>
<?php
      //echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";
  }
	  
	}
  else{ 
//echo ("<script language='javascript'> window.alert('Login failed, check username then try again')</script>");
$_SESSION['fail'] = "Login failed, check username then try again";
      echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";
  }
	
  }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}

else if(isset($_GET['out'])){
unset($_SESSION['is_logged']);
unset($_SESSION['username']);
unset($_SESSION['uid']);
unset($_SESSION['role']);
//header("Location: ../index.php");?>
<script>
window.location.href = '../index.php';
</script>
<?php
//echo "<meta http-equiv='refresh' content='0;url=../index.php'> ";
}
else{
?>

<!--Sign up modal-->
<!-- Modal -->
<div id="ModalSign" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Service Providers Sign Up</h4>
      </div>
      <div class="modal-body">
	  <form action="includes/signlogin.php" class="form-group" method="post">
Company Name<br/><input type="text" name="cname" class="form-control add-todo" id="log" placeholder="Enter the company/group name"  required /></br>
Company Location<br/><input type="text" name="loc" class="form-control add-todo" id="log" placeholder="Enter the company/group base"  required /></br>
Email<br/><input type="email" name="email" class="form-control add-todo" id="log" placeholder="Enter the company/group email"  required /></br>
Phone Number<br/><input type="text" name="phone" class="form-control add-todo" id="log" onKeyPress="return numbersonly(event)" placeholder="Enter the company/group phone number"  required /></br>
Till Number<br/><input type="text" name="till" class="form-control add-todo" id="log" onKeyPress="return numbersonly(event)" placeholder="Enter the company/group Mpesa till number"  required /></br>
Username<br/><input type="text" name="username" class="form-control add-todo" id="log" placeholder="Provide a username" title="You'll need this username to sign in" required /></br>
<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
Password<br/><input type="text" name="password" class="form-control add-todo" id="pass" placeholder="Enter a password" onkeyup="checkPasswordMatch1();" required /></br>
Re-Enter Password<input type="password1" class="form-control add-todo" name="pass2" id="pass2" onkeyup="checkPasswordMatch();" placeholder="Enter Your Password"  required/></br>

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="float: left;" data-dismiss="modal">Close</button>
        <input type="submit" name="sign" class="btn btn-primary" style="float: right;" value="Sign Up" id="submit1">			
   </form>
      </div>
    </div>

  </div>
</div>
<!--End of sign up modal -->


<!--Login modal-->
<!-- Modal -->
<div id="ModalLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
       <form action="includes/signlogin.php" class="form-group" method="post">
<input type="text" name="username" class="form-control add-todo" id="log" placeholder="Enter Your Username"  required /></br>

<div class="" id="failedlogindiv"></div>

<td><input type="password" class="form-control add-todo" name="password" id="log" placeholder="Enter Your Password"  required/></br>
<a href="#">Forgot Password? </a></td>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="float: left;" data-dismiss="modal">Close</button>
<input type="submit" name="login" class="btn btn-primary" style="float: right;" value="Log In" id="submit">			
</form>
      </div>
    </div>

  </div>
</div>
<!--End of Login modal -->

<?php } ?>