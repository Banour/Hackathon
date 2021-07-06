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

  include 'connection_db.php';
?>
<head>
<style>

body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
}

table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 88%;
  margin-left:6%;
  table-layout: fixed;
}



table caption {
  font-size: 1.5em;
  margin: 0.5em 0 0.75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: 0.35em;
}

table th,
table td {
  padding: 0.625em;
  text-align: center;
  position:top;
}

table th {
  font-size: 0.85em;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  top:-1px;
  position:sticky;
  background-color:#1b4560;
  color:white;
}
.searchinput{
    box-sizing: border-box;
    height:3.8%;
    border-radius:3px;
    border:none;


}
.searchbutton{
    margin-left:0%; font-size:1em;
    height:3.8%;
    cursor:pointer;
  }
.example{
    margin-top:3%;
}
@media screen and (max-width: 1100px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 4.5em;
  }

  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: 0.9em;
  }

  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: 1.8em;
    text-align: right;
  }

  table td::before {
    
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }

  table td:last-child {
    border-bottom: 0;
  }

  .searchinput{
    margin-left:1%;height:5%; width:45%; font-size:3em;
  }
  .searchbutton{
    margin-left:2%; margin-top:1%; font-size:3.8em; height:4.5%;
  }
}

</style>


  <meta charset="UTF-8">
</head>

<?php include 'menu.php';?>

<center><form method="post" action="patient_records.php" class="example" action="#" >
    <input class='searchinput' type="text" placeholder="Search.." name="search" value='<?php //echo $search?>' pattern="[a-zA-Z0-9\s]+" title="Only alphanumeric characters are allowed" required>
    <button class='searchbutton' style='border:none; background-color:#d8e0e5;' type="submit">&#128269;</button>
  </form></center>
<table>
  <caption>Patient Records</caption>
  
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">F.Name</th>
      <th scope="col">L.Name</th>
      <th scope="col">Birth</th>
      <th scope="col">Phone</th>
      <th scope="col">Medical Service</th>
      <th scope="col">Clinical Information</th>
      <th scope="col">Scanner</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $sql='SELECT * FROM patient';
    $stmt = $conn->query($sql);
    while ($row = $stmt->fetch()) { 
      echo'
    <tr>
      <td data-label="ID">'.$row['id'].'</td>
      <td data-label="F.Name">'.$row['fname'].'</td>
      <td data-label="L.Name">'.$row['lname'].'</td>
      <td data-label="Birth">'.$row['birth'].'</td>
      <td data-label="Phone">'.$row['telephone'].'</td>
      <td data-label="Medical Service">'.$row['service'].'</td>
      <td data-label="Clinical Information">'.$row['rens'].'</td>
      <td data-label="Scanner">'.$row['scanner'].'</td>
      <td data-label="Action" style="font-size:1.8em;"><a href="Consultation_Calendar.php?service='.$row['service'].'&rens='.$row['service'].'&fname='.$row['fname'].'&lname='.$row['lname'].'">&#128197;</a></td>
      
    </tr>';
    }
?>
   
    
  </tbody>
</table>
