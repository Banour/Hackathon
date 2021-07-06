<?php 

session_start();
if(!isset($_SESSION['login'])){
  header('Location: access_denied.php');
}

  if($_SESSION['role']!='Doctor'){
    header('Location: access_denied.php');
  }




$date=new DateTime(date("Y-m-d H:i:s"));?>

<!DOCTYPE html>
<html>
  <style>
    .alert.success {background-color: #3099e7;}

.alert {
  width:50%;
  padding: 15px;
  background-color: #f44336;
  color: white;
  opacity: 0.95;
  transition: opacity 0.6s;
  margin-bottom: -3%;
  border-radius:4px;
  font-size:14px;
  margin-top:3%;
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
  </style>
  <head>
  <link rel="icon" type="image/png" href="asset/logo_hopital_militaire.png" />
    <title>HMPIT - Consultation Calendar</title>
    <!-- (A) JS + CSS -->
    <link rel="stylesheet" href="3b-calendar.css">
    <script src="3c-calendar.js"></script>
  </head>
  <body>
    <?php include 'menu.php';?>
    <br>
    <div class='main'>
      <center><h2>Consultation Calendar</h2></center>

<?php

$fname=$_GET['fname'];
$lname=$_GET['lname'];
$rens=$_GET['rens'];
$service=$_GET['service'];

echo"
      <center><div class='alert success'>
  		<span class='closebtn'>&times;</span>  
  		<strong>Info!</strong> The most appropriate suggested date for $fname $lname with clinical information $rens is $rdv .
		</div></center>
    ";

?>

    <!-- (B) PERIOD SELECTOR -->
    <div style='margin-top: 6%; margin-left:7%;' id="calPeriod"><?php
      // (B1) MONTH SELECTOR
      // NOTE: DEFAULT TO CURRENT SERVER MONTH YEAR
      $months = [
        1 => "January", 2 => "Febuary", 3 => "March", 4 => "April",
        5 => "May", 6 => "June", 7 => "July", 8 => "August",
        9 => "September", 10 => "October", 11 => "November", 12 => "December"
      ];
      $monthNow = date("m");
      echo "<select id='calmonth'>";
      foreach ($months as $m=>$mth) {
        printf("<option value='%s'%s>%s</option>", 
          $m, $m==$monthNow?" selected":"", $mth
        );
      }
      echo "</select>";

      // (B2) YEAR SELECTOR
      echo "<input type='number' id='calyear' value='".date("Y")."'/>";
    ?></div>


    


    <!-- (C) CALENDAR WRAPPER -->
    <div style='width:85%; margin-left:7%;' id="calwrap"></div>

    <!-- (D) EVENT FORM -->
    <div id="calblock"><form id="calform">
    <input type="button" id="calformcx" style="margin-left:93%; width:6%; font-size:27px; border:none; height:27px; cursor:pointer; padding-top:3px;" value="&times;"/>
      <input type="hidden" id="evtid"/>  
      <label for="start" style='margin-top:-3%;'>Consultation Date</label>
      <input type="date" id="evtstart" required/>
      
      <input type="date" id="evtend" style="display:none;" />
      <label for="txt">Consultation</label>
      <textarea id="evttxt" required></textarea>
      
      <input type="color" id="evtcolor" value='#4CD6BF' style='display:none;' required/>
      <input type="submit" id="calformsave" value="Save"/>
      <input type="button" id="calformdel" value="Delete"/>
      
    </form></div>
    </div>
  </body>




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
</html>