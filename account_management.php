<?php 
session_start();
if ((!isset($_SESSION['login'])) || ($_SESSION['role'] != 'Admin')) {
    header('Location: access_denied.php');
}
include 'connection_db.php';
$date=new DateTime(date("Y-m-d H:i:s"));
$login="";
$fname="";
$lname="";
$nin="";
$tel="";

$role="";
$address="";
$new_pwd="";
$conf_pwd="";
$deleted=0;
if (isset($_GET['login']) && (isset($_GET['action']))) {
	$action=$_GET['action'];
	$login=$_GET['login'];
	if($action == 2){
		$login=$_GET['login'];
		$sql = "DELETE FROM staff WHERE login='$login' ";
		$conn->query($sql);
    	$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
		file_put_contents("Log.log", $event."\n", FILE_APPEND);
		$deleted=1;
		$login="";
	}else{
    	$sql="SELECT * FROM staff where login='$login'";
		$stmt = $conn->query($sql);
    	$row = $stmt->fetch();
		$login=$row['login'];
		$fname=$row['fname'];
		$lname=$row['lname'];
		$nin=$row['cin'];
		$tel=$row['tel'];
		
		
		$role=$row['role'];
		$address=$row['address'];
	
	}
	
}


$search="";

$succ_save=0;
$succ=0;
$existLogin=0;
$existNIN=0;
$diff_pwd=0;




if(isset($_POST['add'])){
	$login=$_POST['login'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
    $nin=$_POST['nin'];
	$tel=$_POST['tel'];
	
	$address=$_POST['address'];
	$role=$_POST['role'];
	$new_pwd=$_POST['new_pwd'];
	$conf_pwd=$_POST['conf_pwd'];

	if($new_pwd == $conf_pwd){
		$sql="SELECT * FROM staff where (cin='".$nin."')";
  		$stmt = $conn->query($sql);
		$count = $stmt->rowCount();
		if($count==0){
			
			$sql="SELECT * FROM staff where (login='".$login."')";
  			$stmt = $conn->query($sql);
			$count = $stmt->rowCount();
			if($count==0){
				$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
				$sql = "INSERT INTO staff VALUES ('$nin', '$fname', '$lname', '$tel', '$address', '$login', '$hashed_pwd', '$role')";
  				$conn->exec($sql);
				$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
				file_put_contents("Log.log", $event."\n", FILE_APPEND);
				
				


				$succ=1;
				$login="";
				
			    $nin="";
				$tel="";
				
				$address="";
				$role="";
				$new_pwd="";
				$conf_pwd="";

			}else{
				$existLogin=1;
			}
		}else{
			$existNIN=1;
		}

			
	}else{
		$diff_pwd=1;
	}

}







if(isset($_POST['save'])){
	$login=$_POST['login'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
    $nin=$_POST['nin'];
	$tel=$_POST['tel'];
	
	$address=$_POST['address'];
	$role=$_POST['role'];
	$new_pwd=$_POST['new_pwd'];
	$conf_pwd=$_POST['conf_pwd'];
	$old_login=$_POST['old_login'];
	$old_nin=$_POST['old_nin'];
	$action=1;
	if(strcmp($new_pwd,$conf_pwd)==0){

		if($old_login != $login){
			$sql="SELECT * FROM ";
  			$stmt = $conn->query($sql);
			$result = $stmt->fetch();
			$count = $stmt->rowCount();
			if($count==0){
				if($old_nin != $nin){ //login changé cin changé
					$sql="SELECT * FROM staff cin='".$nin."'";
  					$stmt = $conn->query($sql);
					$result = $stmt->fetch();
					$count = $stmt->rowCount();
					if ($count==0){
						$sql = "UPDATE staff SET staff='".$login."' , fname='".$fname."' , lname='".$lname."' , cin=".$nin." , 
        				address='".$address."' , tel=".$tel." WHERE (login='".$old_login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						if(strlen($new_pwd)>0){
							$hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
							$sql = "UPDATE login SET pwd='".$hashed_pwd."', role='".$role."' WHERE (login='".$login."')"; 
  							$conn->exec($sql);
							$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
							file_put_contents("Log.log", $event."\n", FILE_APPEND);
						}
						$sql = "UPDATE login SET role='".$role."' WHERE (login='".$login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						$succ_save=1;

						$login="";
						$fname="";
						$lname="";
 						$nin="";
						$tel="";
						
						$address="";
						$role="";
						$new_pwd="";
						$conf_pwd="";
						$old_login="";
						$old_nin="";
					}else{
						$existNIN=1;
					}
				}else{ //login changé cin inchangé
							$sql = "UPDATE staff SET login='".$login."' , fname='".$fname."' , lname='".$lname."' , 
							address='".$address."' , tel=".$tel." WHERE (login='".$old_login."')"; 
							  $conn->exec($sql);
							$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
							file_put_contents("Log.log", $event."\n", FILE_APPEND);
							if(strlen($new_pwd)>0){
								$hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
								$sql = "UPDATE staff SET pwd='".$hashed_pwd."', role='".$role."' WHERE (login='".$login."')"; 
								  $conn->exec($sql);
								$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
								file_put_contents("Log.log", $event."\n", FILE_APPEND);
							}

							$sql = "UPDATE staff SET role='".$role."' WHERE (login='".$login."')"; 
  							$conn->exec($sql);
							$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
							file_put_contents("Log.log", $event."\n", FILE_APPEND);
							$succ_save=1;

							$login="";
							$fname="";
							$lname="";
 							$nin="";
							$tel="";
							
							$address="";
							$role="";
							$new_pwd="";
							$conf_pwd="";
							$old_login="";
							$old_nin="";
				}
			}else{
				$existLogin=1;
			}
		}else{
			if($old_nin != $nin){ //login changé cin changé
					$sql="SELECT * FROM staff where cin='".$nin."' ";
  					$stmt = $conn->query($sql);
					$result = $stmt->fetch();
					$count = $stmt->rowCount();
					if($count==0){
						$sql = "UPDATE staff SET staff='".$login."' , fname='".$fname."' , lname='".$lname."' , cin=".$nin." , 
        				address='".$address."' , tel=".$tel." WHERE (login='".$old_login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						if(strlen($new_pwd)>0){
							$hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
							$sql = "UPDATE staff SET pwd='".$hashed_pwd."', role='".$role."' WHERE (login='".$login."')"; 
  							$conn->exec($sql);
							$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
							file_put_contents("Log.log", $event."\n", FILE_APPEND);
						}
						$sql = "UPDATE staff SET role='".$role."' WHERE (login='".$login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						$succ_save=1;

						$login="";
						$fname="";
						$lname="";
 						$nin="";
						$tel="";
						
						$address="";
						$role="";
						$new_pwd="";
						$conf_pwd="";
						$old_login="";
						$old_nin="";
					}else{
						$existNIN=1;
					}
			}else{
				$sql = "UPDATE staff SET fname='".$fname."' , lname='".$lname."' , cin=".$nin." , 
        				address='".$address."' , tel=".$tel." WHERE (login='".$old_login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						if(strlen($new_pwd)>0){
							$hashed_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);
							$sql = "UPDATE staff SET pwd='".$hashed_pwd."', role='".$role."' WHERE (login='".$login."')"; 
  							$conn->exec($sql);
							$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
							file_put_contents("Log.log", $event."\n", FILE_APPEND);
						}

						$sql = "UPDATE staff SET role='".$role."' WHERE (login='".$login."')"; 
  						$conn->exec($sql);
						$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
						file_put_contents("Log.log", $event."\n", FILE_APPEND);
						$succ_save=1;

						$login="";
						$fname="";
						$lname="";
 						$nin="";
						$tel="";
						
						$address="";
						$role="";
						$new_pwd="";
						$conf_pwd="";
						$old_login="";
						$old_nin="";
			}
		}

		
	}else{
		$diff_pwd=1;
		$new_pwd="";
		$conf_pwd="";
	}
}


















if(isset($_POST['search'])){
	$search=$_POST['search'];
	$sql="SELECT * FROM staff where (login='".$search."') OR (fname LIKE '%".$search."%') OR (lname LIKE '%".$search."%')
	OR (CIN ='$search') OR (role LIKE '%".$search."%') ";
  $event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
	file_put_contents("Log.log", $event."\n", FILE_APPEND);
}else{
	$sql="SELECT * FROM staff";	
}















?>




<head>
<style>
*, *:before, *:after {
  box-sizing: border-box;
}

a:visited {
  color: inherit;
}

body {font-family: "Roboto", sans-serif;background-color: rgba(243, 243, 243, 0.966);}



.container {
  max-width: 77%;
  margin-right: auto;
  margin-left: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 3%;
  
}

.table {
  width: 135%;
  border: 1px solid #EEEEEE;
  
}

.table-header {
  display: flex;
  width: 100%;
  background: #093669;
  padding: 18px 0;
  position: sticky;
  top: -0.2;
  border-radius: 3px;
  font-size:14px;
}

.table-row {
  display: flex;
  width: 100%;
  padding: 18px 0;
  
}
.table-row:nth-of-type(odd) {
  background: rgba(221, 221, 221, 0.25);
}

.table-data {
  flex: 1 1 20%;
  text-align: center;
  font-size:15px;
  
}


.header__item {
  flex: 1 1 20%;
  text-align: center;
}

.header__item {
  text-transform: uppercase;
  font-size:14px;
}

.filter__link {
  color: white;
  text-decoration: none;
  position: relative;
  display: inline-block;
  padding-left: 24px;
  padding-right: 24px;
}




















form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid ;
  border-color: #a7a7a734;
  float: left;
  width: 80%;
  background: rgba(243, 243, 243, 0.966);
  border-radius: 3px;
}

form.example button {
  float: left;
  width: 20%;
  padding: 9px;
  background: #598fbb10;
  color: white;
  font-size: 17px;
  border: none;
  border-left: none;
  cursor: pointer;
  border-radius: 3px;
}

form.example button:hover {
  background: #03405c10;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}












.alert.success {background-color: #4CAF50;}

.alert {
  width:100%;
  padding: 15px;
  background-color: #f44336;
  color: white;
  opacity: 0.95;
  transition: opacity 0.6s;
  margin-bottom:3%;
  margin-top:-5%;
  border-radius:4px;
  font-size:14px;
}


.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}














































.form-style-10{
	width:360px;
	padding:30px;
	margin:40px auto;
	background: #FFF;
	border-radius: 10px;
	-webkit-border-radius:10px;
	-moz-border-radius: 10px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	display: inline-block;
	float:left; margin-left:12%; margin-right:6%;
	
}
.form-style-10 .inner-wrap{
	padding: 30px;
	background: #F8F8F8;
	border-radius: 6px;
	margin-bottom: 15px;
}
.form-style-10 h3{
	background: #093669;
	opacity: 0.9;
	padding: 15px 30px 15px 30px;
	margin: -30px -30px 30px -30px;
	border-radius: 10px 10px 0 0;
	-webkit-border-radius: 10px 10px 0 0;
	-moz-border-radius: 10px 10px 0 0;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 30px 'Bitter', serif;
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: 1px solid #257C9E;
}
.form-style-10 h3 > span{
	display: block;
	margin-top: 2px;
	font: 13px Arial, Helvetica, sans-serif;
}
.form-style-10 label{
	display: block;
	font: 13px Arial, Helvetica, sans-serif;
	color: #888;
	margin-bottom: 15px;
}
.form-style-10 input[type="text"],
.form-style-10 input[type="date"],
.form-style-10 input[type="datetime"],
.form-style-10 input[type="email"],
.form-style-10 input[type="number"],
.form-style-10 input[type="search"],
.form-style-10 input[type="time"],
.form-style-10 input[type="url"],
.form-style-10 input[type="password"],
.form-style-10 textarea,
.form-style-10 select {
	display: block;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	padding: 8px;
	border-radius: 6px;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border: 2px solid #fff;
	box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
	-moz-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
	-webkit-box-shadow: inset 0px 1px 1px rgba(0, 0, 0, 0.33);
}

.form-style-10 .section{
	font: normal 20px 'Bitter', serif;
	color: #126384;
	opacity: 0.9;
	margin-bottom: 5px;
}
.form-style-10 .section span {
	background: #126384;
	opacity: 0.9;
	padding: 5px 10px 5px 10px;
	position: absolute;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border: 4px solid #fff;
	font-size: 14px;
	margin-left: -45px;
	color: #fff;
	margin-top: -3px;
}
#button{
	background: #093669;
	opacity:0.85;
	padding: 8px 20px 8px 20px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 30px 'Bitter', serif;
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: none;
	font-size: 15px;
}
#button:hover{
	background: #037688;
	
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.28);
	cursor: pointer;
}
.form-style-10 .privacy-policy{
	float: right;
	width: 250px;
	font: 12px Arial, Helvetica, sans-serif;
	color: #4D4D4D;
	margin-top: 10px;
	text-align: right;
}



















input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
















#abel {
      float: left;
      clear: none;
      display: block;
      padding: 0px 1em 0px 8px;
    }
    
    input[type=radio]
     {
      float: left;
      clear: none;
      margin: 2px 0 0 2px;
    }


	#abel:hover{
		cursor:pointer;
	}






















































@media (max-width: 1500px) {
	.main{
	
	margin-left:-7%;
}
.titre{
	margin-top:6%; margin-bottom:2%; margin-left:5%;
}   
}







</style>
<link rel="icon" type="image/png" href="asset/logo_hopital_militaire.png" />
<title>HMPIT - Account Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8" />
</head>
<?php include 'menu_mng.php'; ?>
<div class="main">
<center><h2 class='titre'>Account Management</h2></center>




  
<form method="post" action="Account_Management.php" class="example" style="margin:auto;max-width:300px">
    <input style='box-sizing: border-box;' type="text" placeholder="Search.." name="search" value='<?php echo $search?>' required pattern="[a-zA-Z0-9\s]+" title="Only alphanumeric characters are allowed">
    <button type="submit">&#128269;</button>
  </form><br>







  <div class="form-style-10" style="">
	<h3><?php if(isset($_GET['action'])){
		if($action == 0) {echo 'View Account';}
		else if ($action == 1) {echo 'Update Account';}
		else {echo 'Add a new account';}
		}else {echo 'Add a new account';}?></h3>
	<form method='POST' action='Account_Management.php'>
		
	<?php if($succ==1){
			echo "<div class='alert success'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Success!</strong> $fname $lname has been added.
		</div>";
		$fname="";
		$lname="";}
		if($existLogin==1){
			echo "<div class='alert'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Error!</strong> There is already an user with this Login, please try another.
		</div>";
		}

		if($existNIN==1){
			echo "<div class='alert'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Error!</strong> There is already an user with this NIN.
		</div>";
		}

		if($diff_pwd==1){
			echo "<div class='alert'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Error!</strong> The new and the confirmed passwords must be identical.
		</div>";
		}

		if($succ_save==1){
			echo "<div class='alert success'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Success!</strong> Changes done.
		</div>";
		}
		?>

		
		<label for="login">Login (<span style=color:red;>*</span>):
		<input type="text" id="login" name="login" placeholder="Login" value='<?php echo $login?>'
		<?php if ((isset($action)) && ($action == 0)) echo 'disabled' ?> required pattern="[a-zA-Z0-9\s][a-zA-Z0-9\s][a-zA-Z0-9\s]+" title="Only alphanumeric characters are allowed and atleast 3 characters"></label>
		
        
		<label for="nom" style='width:45%; display:inline-block;'>First Name (<span style=color:red;>*</span>):
		<input type="text" id="fname" name="fname" placeholder="First name" value='<?php echo $fname?>' 
		<?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required pattern="[a-zA-Z\s]+" title="Only alphabet characters are allowed"></label>
		<label for="prenom" style='width:45%; margin-left:8%; display:inline-block;'>Last name (<span style=color:red;>*</span>):
		<input type="text" id="lname" name="lname" placeholder="Last name" value='<?php echo $lname?>' 
		<?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required pattern="[a-zA-Z\s]+" title="Only alphabet characters are allowed"></label>
        <label for="nin">NIN (<span style=color:red;>*</span>):
        <input type="text" id="nin" name="nin" placeholder="National Identification Number" value='<?php echo $nin?>'
		<?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required pattern="[0-9]{8}" title="The NIN consists of 8 numbers"></label>
		<label for="tel">Phone (<span style=color:red;>*</span>):
        <input type="number" id="phone" name="tel" placeholder="Phone Number" value='<?php echo $tel?>' 
		<?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required pattern="[0-9]{8}" title="The Phone number consists of 8 numbers"></label>
		
		<label for="address">Address:
		<input type="text" id="address" name="address" placeholder="Address" 
		<?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> value='<?php echo $address?>' pattern="[a-zA-Z0-9\s][a-zA-Z0-9\s][a-zA-Z0-9\s]+" title="Only alphanumeric characters are allowed and atleast 3 characters"></label>
		<label for="address">Role (<span style=color:red;>*</span>):
	
			<br><input style='cursor:pointer; width:16px; height:16px; margin-top:1%;' type="radio" class="radio" name="role" value="Doctor" id="Doctor"
			<?php if($role == 'Doctor') echo 'checked' ?> <?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required/>
        <label id="abel" for="Doctor" style='margin-top:1.5%;'>Doctor</label>

		

        <input style='cursor:pointer; margin-left:12%; width:16px; height:16px; margin-top:1%;' type="radio" class="radio" name="role" value="Admin" id="Admin" 
		<?php if($role == 'Admin') echo 'checked' ?> <?php if((isset($action))&& ($action == 0)) echo 'disabled' ?> required/>
        <label id="abel" for="Admin" style='margin-top:1.5%;'>Admin</label>
	
		
		
	
	
	
	</label>
		<?php 
		if(isset($action)){
			if ($action==1){
				echo "<br>
					<label style='margin-top:1%;' for='new_pwd'>New Password:
					<input type='password' id='new_pwd' name='new_pwd' placeholder='New Password' value='$new_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
					<label for='conf_pwd' >Confirm New Password:
					<input type='password' id='conf_pwd' name='conf_pwd' placeholder='Confirm New Password' value='$conf_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
					<center><div class='button-section'>
		 			<input id='button' type='submit' name='save' value='Save'/>
					</div></center>";
			}else if ($action == 2){
				echo "<br>
			<label style='margin-top:1%;' for='new_pwd'>Password:
			<input type='password' id='new_pwd' name='new_pwd' placeholder='Password' value='$new_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
			<label for='conf_pwd' >Confirm Password:
			<input type='password' id='conf_pwd' name='conf_pwd' placeholder='Confirm Password' value='$new_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
			<center><div class='button-section'>
		 	<input id='button' type='submit' name='add' value='Add'/>
			</div></center>";
			}
		}else{
			echo "<br>
			<label style='margin-top:1%;' for='new_pwd'>Password:
			<input type='password' id='new_pwd' name='new_pwd' placeholder='Password' value='$new_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
			<label for='conf_pwd' >Confirm Password:
			<input type='password' id='conf_pwd' name='conf_pwd' placeholder='Confirm Password' value='$new_pwd' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$' title='The password must contain at least 1 Uppercase, Lowercase, Number, Symbol and length between 8 and 12'></label>
			<center><div class='button-section'>
		 	<input id='button' type='submit' name='add' value='Add'/>
			</div></center>";
		}
			?>
		
		<input name="old_login" type="hidden" value='<?php if(isset($_GET['login'])) {echo $_GET['login'];}
		 else if (isset($_POST['login'])) {if ($succ_save==1) {echo $login;} else {echo $old_login;}} ?>' >
    	<input name="old_nin" type="hidden" value='<?php if((isset($_GET['login']))&&($_GET['action'] == 1)){echo $nin;}
		 else if (isset($_POST['nin'])) {if ($succ_save==1) {echo $nin;} else {echo $old_nin;}} ?>' >

		

		
		
	</form>
	
	
  </div>





















	<div class="container" style='display:inline-block; margin-top:4%;'>
	<?php if($deleted == 1){
			echo "<div class='alert' style='width:132%;'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Patient successfully deleted !</strong>
		</div>";
		}?>
	<div class="table">
		<div class="table-header">
			<div class="header__item"><a id="name" class="filter__link" >Login</a></div>
			<div class="header__item"><a id="wins" class="filter__link filter__link--number" >First Name</a></div>
			<div class="header__item"><a id="draws" class="filter__link filter__link--number" >Last Name</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" >Role</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number">Action</a></div>
		</div>
		<div class="table-content">


		<?php

	  $stmt = $conn->query($sql);
		$today = new DateTime(date("Y-m-d"));
		$count = $stmt->rowCount();
		$question="'Are you sure to delete this account ?'";
		if($count>0){
			while ($row = $stmt->fetch()) { 
		
		
			echo '<div class="table-row">		
			<div class="table-data">'.$row['login'].'</div>
			<div class="table-data">'.$row['fname'].'</div>
			<div class="table-data">'.$row['lname'].'</div>
			<div class="table-data">'.$row['role'].'</div>
			<div class="table-data" style="margin-top:-0.5%;"><a href="Account_Management.php?login='.$row['login'].'&action=0"><img src="asset/view.png"></img></a> 
			&nbsp;<a href="Account_Management.php?login='.$row['login'].'&action=1"><img src="asset/edit.png" ></img></a>&nbsp;
			<a href="Account_Management.php?login='.$row["login"].'&action=2" onclick="return confirm('.$question.') ;">
			<img src="asset/delete.png" ></img></div></a>
			</div>';
			}
		}else{
			echo "<div class='table-data'><br> <h3>&#128373; Ops! No account found</h3></div>";

			
			
		}
	    
		?>
        
        </div>
    </div>
</div>

</div>


<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>