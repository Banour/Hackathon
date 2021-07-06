
<?php
$result=4;

$date=new DateTime(date("Y-m-d H:i:s"));
$today=$date->format("Y-m-d");

$rdv=date('Y-m-d', strtotime($today. " + $result days"));
echo $rdv;
 
?>