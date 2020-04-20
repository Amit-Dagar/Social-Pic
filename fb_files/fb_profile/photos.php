<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		include("background.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $name; ?> - Photos</title>
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading" title="Log In to Super Pic Network">
			My Account Photos.</h3>
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
  <li style="height: 39px"><a href="photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
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
			<hr><?php
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	$photos_count=mysql_num_rows($que_post_img);
	$photos_count=$photos_count+$count1+1;
?>
			<div id="timeline_txt_background" style="display: none; height: 9.8%; width: 6.9%; background-color: #F6F7F8; z-index: 1;">
			</div>
			<div id="about_txt_background" style="display: none; top: 51%; width: 5.9%; background-color: #F6F7F8; z-index: 1;">
			</div>
			<div style="font-weight: bold; z-index: 1;">
				<h3 class="form-signin-heading">
				<span class="auto-style1"><a href="timeline.php"><span style="color:#800000">Timeline</span></a></span>&nbsp; |&nbsp;
				<a href="about.php" style="color: #800000;">About</a>&nbsp; |&nbsp;
				<a href="photos.php" style="color: #800000">Photos </a>(<?php echo $photos_count; ?>)</h3>
			</div>
			<hr />
			<div>
				<h2><img src="img/photos.PNG" />Photos :</h2>
				<p></p>
				<hr />&nbsp;
				<p></p>
			</div>
			<script>
function open_profile_photo_album()
{
	document.getElementById("profile_photo_album").style.display='block';
	document.getElementById("albums").style.display='none';
}
function open_cover_photo_album()
{
	document.getElementById("cover_photo_album").style.display='block';
	document.getElementById("albums").style.display='none';
}
function open_timeline_photos_album()
{
	document.getElementById("timeline_photos_album").style.display='block';
	document.getElementById("albums").style.display='none';
}
function back()
{
	document.getElementById("profile_photo_album").style.display='none';
	document.getElementById("cover_photo_album").style.display='none';
	document.getElementById("timeline_photos_album").style.display='none';
	document.getElementById("albums").style.display='block';
}
function open_profile_photo()
{
	document.getElementById("profile_pic_open_box").style.display='block';
}
function close_profile_photo()
{
	document.getElementById("profile_pic_open_box").style.display='none';
}


</script>
			<div id="albums">
				<h3>Profile :</h3>
				<div>
					<img onclick="open_profile_photo_album()" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" />
				</div>
				<div>
					<h3>Cover :</h3>
				</div>
				<div>
					<img id="cover_photo" onclick="open_cover_photo_album()" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Cover/<?php echo $cover_img; ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" />
				</div>
				<div>
				</div>
				<?php
	$img_array = array();
	while($post_img_data=mysql_fetch_array($que_post_img))
	{
		array_push($img_array,$post_img_data[3]);
	}
?>
				<div>
					<h3>Timeline </h3>
				</div>
				<div>
					<img id="timeline_photos" onclick="open_timeline_photos_album()" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Post/<?php echo $img_array[0] ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
			<!--profile_photo_album-->
			<div id="profile_photo_album" style="display: none;">
				<div>
					<img onclick="open_profile_photo()" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Profile/<?php echo $img; ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" />
				</div>
				<div>
					<img height="50" onclick="back()" src="img/Go%20back.png" width="50" />
				</div>
			</div>
			<!--cover_photo_album-->
			<div id="cover_photo_album" style="display: none;">
				<div>
					<img onclick="open_cover_photo()" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Cover/<?php echo $cover_img; ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" />
				</div>
				<div>
					<img height="50" onclick="back()" src="img/Go%20back.png" width="50" />
				</div>
			</div>
			<!--timeline_photos_album-->
			<div id="timeline_photos_album" style="display: none;">
				<div style="height: 1<?php echo $photos_count-2; ?>0%; height: 0; width: 0; box-shadow: 0px -1px 5px 1px rgb(0,0,0); z-index: -1;">
					<br></div>
				<script>
function()
	{	
  			var details=document.getElementById("photos_ID");
	  		details.innerHTML=xmlhttp.responseText;
	}
	xmlhttp.open("GET","open_timeline_photos_album.php?photo="+photo_id,true);
	break;
	xmlhttp.send(null);
}

function close_timeline_album_photo()
{
	document.getElementById("timeline_album_photo").style.display='none';
	}
</script>
				<div>
					<img height="50" onclick="back()" src="img/Go%20back.png" width="50" />
					<table cellpadding="41">
						<tr>
							<?php
	$tr=0;
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	
	while($post_img_data=mysql_fetch_array($que_post_img))
	{
		$tr=$tr+1;
		
?>
							<td>
							<img onclick="timeline_photos_open(<?php echo $post_img_data[0]; ?>)" src="../../fb_users/<?php echo $gender; ?>/<?php echo $user; ?>/Post/<?php echo $post_img_data[3]; ?>" style="height: 200; width: 200; box-shadow: 0px 0px 5px 1px rgb(0,0,0);" /><br>
							<br/></td>
							<?php
		if($tr>=3)
		{
			echo "</tr>";
			$tr=0;
		}
	}
?>
						</tr>
					</table>
				</div>
			</div>
			<div id="photos_ID">
				<hr />
				<div>
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
  <li style="height: 39px"><a href="photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
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
.auto-style1 {
	color: #800000;
}
</style>

<div id="Home0" class="tabcontent">
  <h3>Home</h3>
  <div class="loader"></div>
  <p>Loading Please wait....</p>
</div>

<div id="My account0" class="tabcontent">
  <h3>My account</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p> 
</div>

<div id="Profile0" class="tabcontent">
  <h3>Profile</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>
<div id="feedback0" class="tabcontent">
  <h3>feedback</h3>
 <div class="loader"></div>
 <p>Loading Please wait....</p>
</div>

<div id="Logout?0" class="tabcontent">
  <h3>Logout?</h3>
  <div class="loader"></div>
<p>Loading Please wait....</p> 
</div>

<div id="Settings0" class="tabcontent">
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
				<hr/></div>
			</div>
		</form>
	</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>

</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>