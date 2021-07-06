<?php 
session_start();


if ((!isset($_SESSION['login'])) || ($_SESSION['role'] != 'Admin')) {
    header('Location: access_denied.php');
}

?>
<head>
<link rel="icon" type="image/png" href="asset/logo_hopital_militaire.png" />
<title>HMPIT - Log File</title>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8" />
</head>
<?php include 'menu_mng.php'; ?>
<div class="main">
<h2 style='margin-top:2%; margin-bottom: 2%; margin-left: 45%;'>Log</h2>

<center><textarea style="resize: none; width:80%; height: 65%; margin-top:4%; border-radius:5px; border:none; background-color:#f8f8f8;"  readOnly>
<?php
$tab = file('Log.log');




$nbLignes=count($tab);

if($nbLignes>=150){
	for($i=($nbLignes-150);$i<$nbLignes;$i++){
		$ligne = $tab[$i];
		echo $ligne."\n";
	}
}else{
	for($i=0;$i<$nbLignes;$i++){
		$ligne = $tab[$i];
		echo $ligne."\n";
	}
}
?>
</textarea></center>
</div>