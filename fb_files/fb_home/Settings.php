<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		mysql_connect("localhost","root","Palwal");
		mysql_select_db("faceback");
		$user_email=$_SESSION['fbuser'];
		$que_user_info=mysql_query("select * from users where Email='$user_email'");
		$user_data=mysql_fetch_array($que_user_info);
		$userid=$user_data[0];
		$user_name=$user_data[1];
		$user_pass=$user_data[3];
		
		$last_name_pos=strrpos($user_name," ");
		$last_name_pos=$last_name_pos+1;
		$first_name=strstr($user_name,' ',1);
		$last_name=substr($user_name,$last_name_pos,strlen($user_name));
	
?><?php
	if(isset($_POST['change_name']))
	{
		$Name=$_POST['fnm'].' '.$_POST['lnm'];
		mysql_query("update users set Name='$Name' where user_id=$userid;");
		header("location:Settings.php");
	}
	if(isset($_POST['change_password']))
	{
		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		if($user_pass==$old_password)
		{
			mysql_query("update users set Password='$new_password' where user_id=$userid;");
		}
		else
		{
			echo " <script> alert('old password Wrong') </script>";
		}
	}
	if(isset($_POST['detete_id']))
	{
		$uid=$_POST['uid'];
		mysql_query("delete from users where user_id=$uid;");
		header("location:../../index.php");
	}
	
?><?php
	include("background.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Social CS - Log In</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="Settings_css/Settings.css" rel="stylesheet" type="text/css" />
<script src="Settings_js/Settings.js" type="text/javascript"> </script>
</head>

<body>

<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading" title="User Account Settings">Account 
			Settings</h3>
			<hr>
			<div class="form-signin">
									<style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    -webkit-animation: fadeEffect 1s;
    animation: fadeEffect 1s;
}

@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>

<ul class="tab" style="height: 48px">
  <li style="height: 39px"><a href="../fb_home/Home.php" class="tablinks" onclick="openCity(event, 'Home')"><span style="color: blue">Home</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
  <li style="height: 39px"><a href="../fb_home/feedback.php" class="tablinks" onclick="openCity(event, 'feedback')"><span style="color: blue">feedback</span></a></li>
  <li style="height: 39px"><a href="../fb_logout/logout.php" class="tablinks" onclick="openCity(event, 'Logout?')"><span style="color: blue">Logout?</span></a></li>
  <li style="height: 39px"><a href="../fb_home/Settings.php" class="tablinks" onclick="openCity(event, 'Settings')"><span style="color: blue">Account Settings</span></a></li>
</ul>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
  <div class="loader"></div>
  <p>Loading Please wait....</p>
</div>

<div id="My account" class="tabcontent">
  <h3>My account</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p> 
</div>

<div id="Profile" class="tabcontent">
  <h3>Profile</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>
<div id="feedback" class="tabcontent">
  <h3>feedback</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>

<div id="Logout?" class="tabcontent">
  <h3>Logout?</h3>
  <div class="loader"></div>
<p>Loading Please wait....</p> 
</div>

<div id="Settings" class="tabcontent">
  <h3>Account Settings</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
</div>
			<br>
			<hr>
			<div style="color: #3B59A4; font-size: 24px;">
				Name </div>
			<div style="color: #909DB2; font-size: 24px; text-transform: capitalize;">
				<?php echo $user_name; ?></div>
			<div>
				<img height="70" onclick="Change_name()" src="img/edit-icon.png" width="70" />
			</div>
			<hr />
			<div style="color: #3B59A4; font-size: 24px;">
				Paasword </div>
			<div style="color: #909DB2; font-size: 24px;">
				******** </div>
			<div>
				<img height="70" onclick="Change_password()" src="img/edit-icon.png" width="70" />
			</div>
			<hr />
			<div>
				<?php //<input type="button" value="Deactivate your account." style="background:#FFF; color:#3B59A4; font-size:15px; border:none;" onClick="delete_account()"> </div>?>
				<!--Name change dailog box-->
				<h3 class="form-signin-heading" title="Change User Name">Change Name? 
			</h3>
						<form class="form-signin" method="post" name="name_change" onsubmit="return name_check();">
			<div style="z-index: 4; font-size: 18px;">
				First Name </div>
			<div>
				<input maxlength="15" name="fnm" style="color:navy; height: 35; width: 200;  font-size: 18px;" type="text"  value="<?php echo $first_name; ?>" />
			</div>
			<div style="font-size: 18px;">
				Last Name </div>
			<div>
				<input maxlength="15" name="lnm" style="color:navy; height: 35; width: 200;   font-size: 18px;" type="text" value="<?php echo $last_name; ?>" />
			</div>
			<div>
				<input class="save_button" name="change_name" type="submit" value="Save" />
			</div>
		</form><br/><br/>
		<h3 class="form-signin-heading" title="Change User Pasword">Change  
			Password?</h3>
		<form  method="post" name="password_change" onsubmit="return password_check()">
		<div style="font-size: 18px;">
			Old Password </div>
		<div>
			<input maxlength="30" name="old_password" style="height: 30; width: 240; font-size: 18px;" type="password" />
		</div>
		<div style="z-index: 4; font-size: 18px;">
			New Password </div>
		<div>
			<input maxlength="30" name="new_password" style="height: 30; width: 240; font-size: 18px;" type="password" />
		</div>
		<div style="font-size: 18px;">
			Confirm Password </div>
		<div>
			<input maxlength="30" name="c_password" style="height: 30; width: 240; font-size: 18px;" type="password" />
		</div>
		<div>
			<input class="save_button" name="change_password" type="submit" value="Change" />
		</div>
	</form>
	<div class="form-signin" style="color=#800000"> 
      
        <h4 class="form-signin-heading" title="Welcome To Super Pic.">Settings</h4>
	<a href="../fb_logout/logout.php" style="text-decoration:none; color:#000;" id="head_logout" onMouseOver="head_logout_over()" onMouseOut="head_logout_out()"><hr/>	   
		</a>
	    						<style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    -webkit-animation: fadeEffect 1s;
    animation: fadeEffect 1s;
}

@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
</style>

<ul class="tab" style="height: 48px">
  <li style="height: 39px"><a href="../fb_home/Home.php" class="tablinks" onclick="openCity(event, 'Home')"><span style="color: blue">Home</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
  <li style="height: 39px"><a href="../fb_home/feedback.php" class="tablinks" onclick="openCity(event, 'feedback')"><span style="color: blue">feedback</span></a></li>
  <li style="height: 39px"><a href="../fb_logout/logout.php" class="tablinks" onclick="openCity(event, 'Logout?')"><span style="color: blue">Logout?</span></a></li>
  <li style="height: 39px"><a href="../fb_home/Settings.php" class="tablinks" onclick="openCity(event, 'Settings')"><span style="color: blue">Account Settings</span></a></li>
</ul>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div id="Home" class="tabcontent">
  <h3>Home</h3>
  <div class="loader"></div>
  <p>Loading Please wait....</p>
</div>

<div id="My account" class="tabcontent">
  <h3>My account</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p> 
</div>

<div id="Profile" class="tabcontent">
  <h3>Profile</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>
<div id="feedback" class="tabcontent">
  <h3>feedback</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>

<div id="Logout?" class="tabcontent">
  <h3>Logout?</h3>
  <div class="loader"></div>
<p>Loading Please wait....</p> 
</div>

<div id="Settings" class="tabcontent">
  <h3>Account Settings</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<h4> </a> </h4>
	   </a> 
<div>
	<a href="../fb_logout/logout.php" style="text-decoration:none; color:#000;" id="head_logout0" onMouseOver="head_logout_over()" onMouseOut="head_logout_out()"><hr/>	   
	</a></a></div>

	</div>
	<!--password change dailog box-->
		
		<!--password change dailog box boder-->
	<!--delete_account  dailog box-->
	<div id="delete_account_dailogbox" style="display: none;">
		<div onclick="hide_delete_account_box()" style="background: #3A3E41; opacity: 0.8; height: 100%; width: 100%; z-index: 3">
		</div>
		<div style="background: #3B5998; height: 10%; width: 35%; z-index: 3">
		</div>
		<div>
			<img height="50" src="img/QuestionMark.png" width="50" /> </div>
		<div>
			<h2 style="color: #FFFFFF;">You want Delete your Account? </h2>
		</div>
		<div>
			<input onclick="hide_delete_account_box()" style="height: 22; width: 22; background: url(img/exit.png); no-repeat; border: none;" type="button" />
		</div>
		<div>
			<img src="img/sad.gif" /> </div>
		<div>
			<form class="form-signin" method="post">
				<input name="uid" type="hidden" value="<?php echo $userid; ?>" />
				<input id="yes_button" name="detete_id" type="submit" value="Yes" />
			</form>
		</div>
		<div>
			<input id="no_button" onclick="hide_delete_account_box()" type="button" value="No" />
		</div>
		<div>
			<img height="110" src="img/smile.gif" width="90" /> </div>
		<div style="background: #FFFFFF; height: 30%; width: 35%; z-index: 3">
		</div>
		<div style="height: 6%; width: 34.9%; background: #E9EAED; z-index: 3;">
		</div>
		<!--delete account  dailog box boder-->
		<div style="height: 0.7%; width: 35.1%; background-color: #666666; z-index: 3; box-shadow: 0px -6px 10px 1px rgb(0,0,0);">
		</div>
		<div style="height: 40.1%; width: 0.3%; background-color: #666666; z-index: 3; box-shadow: -5px 0px 10px 1px rgb(0,0,0);">
		</div>
		<div style="height: 0.7%; width: 35.1%; background-color: #666666; z-index: 3; box-shadow: 0px 6px 10px 1px rgb(0,0,0);">
		</div>
		<div style="height: 40.1%; width: 0.3%; background-color: #666666; z-index: 3; box-shadow: 5px 0px 10px 1px rgb(0,0,0);">
		</div>
	</div>
</div>
<?php
	include("Settings_error/Settings_error.php");
?>

</body>

</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>