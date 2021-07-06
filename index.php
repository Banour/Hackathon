<?php session_start();
include 'connection_db.php';
$_SESSION['cnx_status']='successful_cnx';
$date=new DateTime(date("Y-m-d H:i:s"));
if(isset($_POST['submit'])){
  $pwd = $_POST['pwd'];
  $sql="SELECT * FROM staff where (login='".$_POST['login']."')";
  $stmt = $conn->query($sql);
	$result = $stmt->fetch();
  //echo $result['pwd'];
  if($pwd == $result['pwd']) {
    $_SESSION['login']=$result['login'];
    $_SESSION['fname']=$result['fname'];
    $_SESSION['lname']=$result['lname'];
    $_SESSION['cin']=$result['cin'];
    $_SESSION['tel']=$result['tel'];
    $_SESSION['role']=$result['role'];
    
    $_SESSION['address']=$result['address'];
     
  }else{
    $_SESSION['cnx_status']='cnx_failed';
  }
  
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>



    .body_login {
		margin:0;
		padding:0;
    
    background-attachment:fixed;
		background-size: cover; /* version standardisée */
    background-image: url('asset/login.jpg'); 
    }


    


    
    .main_login {
        background-color: #FFFFFF;
        width: 300px;
        height: 300px;
        
        margin: 5em auto;
        margin-top: 10%;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
    
    .sign {
        padding-top: 30px;
        color: #3fa7a9;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 22px;
    }
    
    .un {
    width: 75%;
    color: rgb(155, 50, 56);
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1px;
    background: rgba(200, 126, 126, 0.05);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 40px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'robotica', sans-serif;
    }
    
    form.form1 {
        padding-top: 45px;
    }
    
    .pass {
            width: 75%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.05);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 40px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
   
    
    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9CBBB0, #3fa7a9);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 32%;
        font-size: 12px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
		font-family: 'Ubuntu', sans-serif;
    }
    
    .modal {
    position: fixed; /* Stay in place */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
  
    }






    #welcome{
    
    animation: 1.7s ease 0s normal forwards 1 fadein;
}

@keyframes fadein{
    0% { opacity:0; }
    10% { opacity:0; }
    20% { opacity:0; }
    30% { opacity:0; }
    40% { opacity:0; }
    50% { opacity:0.4; }
    60% { opacity:0.6; }
    80% { opacity:0.8; }
    100% { opacity:1; }
}

.successful_cnx{
  display : none;
}
.cnx_failed{
  color: #f4250e;
  font-size: 15px;
  margin-bottom: -6.5%;
}
    
 


@media only screen and (max-width: 1100px) {
  .body_login {
	background-image: url('asset/login.jpg'); 
    background-repeat: no-repeat; 
    background-position: center;
    background-attachment: fixed;       
    background-size: cover;
    height:100%;
    width:100%; 
  }
  .main_login {
        background-color: #FFFFFF;
        width: 300px;
        height: 300px;
        
        margin: 5em auto;
        margin-top: 40%;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
}
    
</style>
<link rel="icon" type="image/png" href="asset/logo_hopital_militaire.png" />
</head>
<html>

<head>
  
  <?php if(!isset($_SESSION['login'])){
    echo "
    <title>HMPIT - Sign In</title>
  
</head>

<body class='body_login'>
    <br/><br/>
    <div class='modal'>
    <div class='main_login'>
        <p class='sign' align='center'>Sign in</p>
        
        <center><p class='".$_SESSION['cnx_status']."'>&#9940; Incorrect username or password</p></center>  
        
        <form method='post' action='index.php' class='form1'>
        <input class='un' type='text' align='center' placeholder='Username' name='login' required >
        <input class='pass' type='password' align='center' placeholder='Password' name='pwd' required>";
        

	    echo "<button class='submit' type='submit' name='submit'>Sign In</button>         
    </div>
</div>
	</form>
     
</body>

</html>";
if($_SESSION['cnx_status'] == 'cnx_failed'){
  $event="## ".$date->format("Y-m-d H:i:s")." | ".$_POST['login']." | Connection attempt failed. ";
  file_put_contents("Log.log", $event."\n", FILE_APPEND);
}

}else{
  echo "echo <title>HMPIT - Welcome</title>
  </head>";
  include 'menu.php';
  if (($_SESSION['role']=='Doctor')){
  echo "<div class='main'>
  <center><h2 id='welcome' style='margin-top:10%; margin-bottom: 3%;'>Welcome Dr. ".$_SESSION['fname']." ".$_SESSION['lname']." </h2></center>
  </div>";}
  else{
    echo "<div class='main'>
  <center><h2 id='welcome' style='margin-top:10%; margin-bottom: 3%;'>Welcome ".$_SESSION['fname']." ".$_SESSION['lname']." </h2></center>
  </div>";
  }
  if(isset($_SESSION['login'])){
    $event="## ".$date->format("Y-m-d H:i:s")." | ".$_SESSION['login']." | Connected.";
    file_put_contents("Log.log", $event."\n", FILE_APPEND);
  }
}?>
  
