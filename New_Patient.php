<?php 
session_start();
if(!isset($_SESSION['login'])){
    header('Location: access_denied.php');
}

if($_SESSION['role']!='Nurse'){
	if($_SESSION['role']!='Doctor'){
	  header('Location: access_denied.php');
	}
  }

$date=new DateTime(date("Y-m-d H:i:s"));

include 'connection_db.php';
$succ=0;
$exist=0;
$id="";
$fname="";
$lname="";
$birth="";
$address="";
$tel="";



if(isset($_POST['add'])){
	$id=$_POST['identifier'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$birth=$_POST['birth'];
	$address=$_POST['address'];
	$tel=$_POST['tel'];
	

	$today = new DateTime(date("Y-m-d"));
    $today=date_format($today, 'Y-m-d');
	$sql="SELECT * FROM patient where (id='".$id."')";
  	$stmt = $conn->query($sql);
	$count = $stmt->rowCount();
	if($count==0){
		

		$stmt = $conn->prepare("INSERT INTO patient VALUES (?, ?, ?, ?, ?, ?)");
    	$stmt->bindParam(1, $id);
    	$stmt->bindParam(2, $fname);
    	$stmt->bindParam(3, $lname);
    	$stmt->bindParam(4, $birth);
		$stmt->bindParam(5, $address);
		$stmt->bindParam(6, $tel);
		
    	$stmt->execute();


		//$sql = "INSERT INTO patient VALUES ('$id', '$fname', '$lname', '$birth', '$address', '$tel')";
  		//$conn->exec($sql);
		$event="# ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | ".$sql;
		file_put_contents("Log.log", $event."\n", FILE_APPEND);
		$succ=1;
		$id="";
		
		$birth="";
		$address="";
		$tel="";
		$tel2="";
	}else{
		$exist=1;
	}
	
}




?>
<style>

.form-style-10{
	width:450px;
	padding:30px;
	margin:40px auto;
	background: #FFF;
	border-radius: 10px;
	-webkit-border-radius:10px;
	-moz-border-radius: 10px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
}
.form-style-10 .inner-wrap{
	padding: 30px;
	background: #F8F8F8;
	border-radius: 6px;
	margin-bottom: 15px;
}
.form-style-10 h1{
	background: #093669;
	opacity: 0.9;
	padding: 20px 30px 15px 30px;
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
.form-style-10 h1 > span{
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
.form-style-10 input[type="button"], 
.form-style-10 input[type="submit"]{
	background: #093669;
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
.form-style-10 input[type="button"]:hover, 
.form-style-10 input[type="submit"]:hover{
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



























.alert.success {background-color: #4CAF50;}

.alert {
  padding: 15px;
  background-color: #f44336;
  color: white;
  opacity: 0.95;
  transition: opacity 0.6s;
  margin-bottom: 15px;
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

.titre{
	margin-top:2%; margin-bottom: 2%; margin-left: 45.5%;color:#0f0f0f;
}






























/*smartphone*/
@media (max-width: 1100px) {
	/*											FORM STYLE										*/
    .form-style-10{
	width:80%;
	padding:30px;
	margin:40px auto;
	background: #FFF;
	border-radius: 10px;
	-webkit-border-radius:10px;
	-moz-border-radius: 10px;
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
	-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
}
.form-style-10 .inner-wrap{
	padding: 30px;
	background: #F8F8F8;
	border-radius: 6px;
	margin-bottom: 15px;
}
.form-style-10 h1{
	background: #093669;
	opacity: 0.9;
	padding: 7.5% 5% 7.5% 30px;
	margin: -30px -30px 30px -30px;
	border-radius: 10px 10px 0 0;
	-webkit-border-radius: 10px 10px 0 0;
	-moz-border-radius: 10px 10px 0 0;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 3.5em 'Bitter', serif;
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: 1px solid #257C9E;
}
.form-style-10 h1 > span{
	display: block;
	margin-top: 2px;
	font: 13px Arial, Helvetica, sans-serif;
}
.form-style-10 label{
	display: block;
	font: 2.2em  Arial, Helvetica, sans-serif;
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
	height: 5%;
	font-size:1.2em;
}

.form-style-10 .section{
	font: normal 2.5em 'Bitter', serif;
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
.form-style-10 input[type="button"], 
.form-style-10 input[type="submit"]{
	background: #093669;
	padding: 4% 10% 4% 10%;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 'Bitter', serif;
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: none;
	font-size: 2.2em;
	margin-top:10%;
}
.form-style-10 input[type="button"]:hover, 
.form-style-10 input[type="submit"]:hover{
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



























.alert.success {background-color: #4CAF50;}

.alert {
  padding: 15px;
  background-color: #f44336;
  color: white;
  opacity: 0.95;
  transition: opacity 0.6s;
  margin-bottom: 15px;
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

.titre{
	margin-bottom: 2%; margin-left: 37%; color:#0f0f0f; font-size:3em;
}

}














</style>
<link rel="icon" type="image/png" href="asset/logo_hopital_militaire.png" />
<title>HMPIT - New Patient</title>
</head>
<?php include 'menu.php'; ?>
<main>
  


	






<!-- 													MAIN	INTERFACE										-->
<h2 class='titre'>New Patient</h2>
  <div class="form-style-10">
	<h1>Add a new patient</h1>
	<form method='POST' action='New_Patient.php'>
		
		<?php if($succ==1){
			echo "<div class='alert success'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Success!</strong> $fname $lname has been added.
		</div>";
		$fname="";
		$lname="";}
		if($exist==1){
			echo "<div class='alert'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Error!</strong> There is already a patient registered with this identifier.
		</div>";
		}
		?>
		<div class="section">Patient Identity</div>
		<div class="inner-wrap">
		<label for="identifiant">Identifier (<span style=color:red;>*</span>):
		<input type="number" min=1 id="identifiant" name="identifier" placeholder="Identifier" value='<?php echo $id?>' required ></label>
		<label for="nom">First Name (<span style=color:red;>*</span>):
		<input type="text" id="nom" name="fname" placeholder="First name" value='<?php echo $fname?>' required pattern="[a-zA-Z\s]+" title="Only alphabet characters are allowed"></label>
		<label for="prenom">Last name (<span style=color:red;>*</span>):
		<input type="text" id="prenom" name="lname" placeholder="Last name" value='<?php echo $lname?>' required pattern="[a-zA-Z\s]+" title="Only alphabet characters are allowed"></label>
		<label for="age">Date of birth (<span style=color:red;>*</span>):
		<input type="date" name="birth" id="birth" value='<?php echo $birth?>' required></label>
		<label for="address">Address:
		<input type="text" id="address" name="address" placeholder="Address" value='<?php echo $address?>' pattern="[a-zA-Z0-9\s]+" title="Only alphanumeric characters are allowed"></label>
		<label for="tel">Phone (<span style=color:red;>*</span>):
		<input type="text" id="tel" name="tel" min=0 placeholder="Phone number" value='<?php echo $tel?>' required pattern="[0-9]{8}" title="The phone number consists of 8 numbers"></label>
		
		</div>


		

		<br>
		<center><div class="button-section">
		 <input type="submit" name="add" value="Add"/>
		</div></center>
	</form>
	
	
  </div>











  </main>
    



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


	




















