<style>
body {
  
  margin: 0;
  font-family: "Open Sans", Helvetica Neue, Helvetica, Arial, sans-serif;
  
  padding-left: 240px;
  background-color: rgba(243, 243, 243, 0.966);
}
main {
  margin-top:5%;
}

.login{
color:#81b2d0
}

a,a:visited{
  text-decoration:none;
  color:white;
}


.menu {
  background: #093669;
  height: 100vh;
  width: 240px;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 5;
  outline: none;
}
.menu .avatar {
  background: rgba(0, 0, 0, 0.1);
  padding: 2em 0.5em;
  text-align: center;
}
.menu .avatar img {
  width: 30%;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #ffea92;
  box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
}
.menu .avatar h2 {
  font-weight: normal;
  margin-bottom: 0;
}
.menu ul {
  list-style: none;
  padding: 0.5em 0;
  margin: 0;
}
.menu ul li {
  padding: 0.5em 1em 0.5em 3em;
  font-size: 1.95em;
  font-weight: regular;
  background-repeat: no-repeat;
  background-position: left 15px center;
  background-size: auto 20px;
  transition: all 0.15s linear;
  cursor: pointer;
  color:white;
}
.menu ul li.icon-addPatient {
  background-image: url("asset/add_patient.png");
}
.menu ul li.icon-records {
  background-image: url("asset/records.png");
}
.menu ul li.icon-appointment {
  background-image: url("asset/appointment.png");
}
.menu ul li.icon-calendar {
  background-image: url("asset/calendar.png");
}
.menu ul li.icon-signOut {
  background-image: url("asset/sign_out.png");
}

.menu ul li.icon-log {
  background-image: url("asset/log.png");
  
}

.menu ul li.icon-accountManagement {
  background-image: url("asset/account_management.png");
  
}
.menu ul li:hover {
  background-color: rgba(0, 0, 0, 0.1);
}
.menu ul li:focus {
  outline: none;
}


  body {
    padding-left: 0;
  }
  .menu {
    width: 20%;
    box-shadow: 0 0 0 100em rgba(0, 0, 0, 0);
    transform: translate3d(-100%, 0, 0);
    transition: all 0.3s ease-in-out;
  }

  @media (min-width: 700px) {
  .menu .smartphone-menu-trigger {
    cursor:pointer;
    width: 30%;
    height: 8%;
    position: absolute;
    left: 100%;
    background: #093669;
  }
}


  .menu .smartphone-menu-trigger:before,
  .menu .smartphone-menu-trigger:after {
    content: "";
    width: 50%;
    height: 2px;
    background: #fff;
    border-radius: 10px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate3d(-50%, -50%, 0);
  }
  .menu .smartphone-menu-trigger:after {
    top: 55%;
    transform: translate3d(-50%, -50%, 0);
  }
  .menu ul li {
    padding: 1em 1em 1em 3em;
    font-size: 1.2em;
  }
  .menu:focus {
    transform: translate3d(0, 0, 0);
    box-shadow: 0 0 0 100em rgba(0, 0, 0, 0.6);
  }
  .menu:focus .smartphone-menu-trigger {
    pointer-events: none;
  }























/*smartphone*/
  @media (max-width: 1500px) {
    .menu {
    width: 70%;
    box-shadow: 0 0 0 100em rgba(0, 0, 0, 0);
    transform: translate3d(-100%, 0, 0);
    transition: all 0.3s ease-in-out;
  }
  .menu .smartphone-menu-trigger {
    cursor:pointer;
    width: 20%;
    height: 6%;
    position: absolute;
    left: 100%;
    background: #093669;
  }

  .menu ul li {
    padding: 1em 1em 1em 3em;
    font-size: 2.2em;
  }




  .menu .avatar img {
  width: 50%;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #ffea92;
  box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
}
.menu .avatar h2 {
  font-weight: normal;
  margin-bottom: 0;
}


.login{
  font-size:2.5em;color:#81b2d0
}







.menu ul li.icon-addPatient {
  background-image: url("asset/add_patient.png");
  background-size:50px;
  margin-left:3%;
}
.menu ul li.icon-records {
  background-image: url("asset/records.png");
  background-size:50px;
  margin-left:3%;
}
.menu ul li.icon-appointment {
  background-image: url("asset/appointment.png");
  background-size:50px;
  margin-left:3%;
}
.menu ul li.icon-calendar {
  background-image: url("asset/calendar.png");
  background-size:50px;
  margin-left:3%;
}
.menu ul li.icon-signOut {
  background-image: url("asset/sign_out.png");
  background-size:50px;
  margin-left:3%;
}

.menu ul li.icon-log {
  background-image: url("asset/log.png");
  background-size:50px;
  margin-left:3%;
}

.menu ul li.icon-accountManagement {
  background-image: url("asset/account_management.png");
  background-size:50px;
  margin-left:3%;
}

}










/*pc banour*/
@media (min-width: 1100px) {
    .menu {
    width: 20%;
    box-shadow: 0 0 0 100em rgba(0, 0, 0, 0);
    transform: translate3d(-100%, 0, 0);
    transition: all 0.3s ease-in-out;
  }
  .menu .smartphone-menu-trigger {
    cursor:pointer;
    width: 15%;
    height: 6%;
    position: absolute;
    left: 100%;
    background: #093669;
  }

  .menu ul li {
    padding: 1em 1em 1em 3em;
    font-size: 1em;
  }

  .menu .avatar img {
  width: 30%;
  border-radius: 50%;
  overflow: hidden;
  border: 4px solid #ffea92;
  box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
}
.menu .avatar h2 {
  font-weight: normal;
  margin-bottom: 0;
}



.menu ul li.icon-addPatient {
  background-image: url("asset/add_patient.png");
  background-size:25px;
}
.menu ul li.icon-records {
  background-image: url("asset/records.png");
  background-size:25px;
}
.menu ul li.icon-appointment {
  background-image: url("asset/appointment.png");
  background-size:25px;
}
.menu ul li.icon-calendar {
  background-image: url("asset/calendar.png");
  background-size:25px;
}
.menu ul li.icon-signOut {
  background-image: url("asset/sign_out.png");
  background-size:25px;
}

.menu ul li.icon-accountManagement {
  background-image: url("asset/account_management.png");
  background-size:25px;
}

.menu ul li.icon-log {
  background-image: url("asset/log.png");
  background-size:25px;
}
.login{
  font-size:1.5em;color:#81b2d0
}

}





</style>

<nav class="menu" tabindex="0">
	<div class="smartphone-menu-trigger"></div>
  <header class="avatar">
  <?php if($_SESSION['role']=='Admin') echo '<img src="asset/admin_avatar.png" />';
  else echo '<img src="asset/user_avatar.png" />';?>
    <h2 class='login'><?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?></h2>
  </header>
	<ul>
  <?php if (($_SESSION['role']=='Doctor')){
    echo '<a href="New_Patient.php"><li tabindex="0" class="icon-addPatient"><span>New Patient</span></li></a>
    <a href="patient_records.php"><li tabindex="0" class="icon-records"><span>Patient Records </span></li></a>
    <a href="Consultation_Calendar.php"><li tabindex="0" class="icon-calendar"><span>Calendar</span></li></a>';
  }else{
    echo '<a href="account_management.php"><li tabindex="0" class="icon-accountManagement"><span>Account Management</span></li></a>
    <a href="log.php"><li tabindex="0" class="icon-log"><span>Log</span></li></a>';
  }?>
    <a href="signout.php"><li tabindex="0" class="icon-signOut"><span>Sign Out</span></li></a>
    
  </ul>
</nav>

