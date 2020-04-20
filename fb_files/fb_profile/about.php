<?php
	session_start();
	if(isset($_SESSION['fbuser']))
	{
		$user=$_SESSION['fbuser'];
		mysql_connect("localhost","root","Palwal");
		mysql_select_db("faceback");
		$query1=mysql_query("select * from users where Email='$user'");
		$rec1=mysql_fetch_array($query1);
		$userid=$rec1[0];
?><?php
	if(isset($_POST['work_sub']))
	{
		$u_job=$_POST['job'];
		$u_edu=$_POST['edu'];
		mysql_query("update user_info set job='$u_job',school_or_collage='$u_edu' where user_id=$userid;");
	}
	
	if(isset($_POST['leving_sub']))
	{
		$u_city=$_POST['city'];
		$u_hometown=$_POST['hometown'];
		mysql_query("update user_info set  	current_city='$u_city',hometown='$u_hometown' where user_id=$userid;");
	}
	
	if(isset($_POST['basic_sub']))
	{
		if($_POST['day']=='Day:' && $_POST['month']=='Month:' && $_POST['year']=='Year:')
		{
			$u_relationship=$_POST['relationship'];
			mysql_query("update user_info set relationship_status='$u_relationship' where user_id=$userid;");
		}
		else
		{
			$day=intval($_POST['day']);
			$month=intval($_POST['month']);
			$year=intval($_POST['year']);
			if(checkdate($month,$day,$year))
			{
				$u_relationship=$_POST['relationship'];
				$u_birthday_date=$_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
				mysql_query("update user_info set relationship_status='$u_relationship' where user_id=$userid;");
				mysql_query("update users set Birthday_Date='$u_birthday_date' where user_id=$userid;");
			}
			else
			{
				echo "<script>
				alert('The selected date is not valid.');
					</script>";
			}
		}
	}
	if(isset($_POST['contact_sub']))
	{
		$u_m_no=$_POST['mno'];
		$u_priority=$_POST['priority'];
		//$u_web=$_POST['web'];
		$u_fb_id=$_POST['fbid'];
		mysql_query("update user_info set mobile_no='$u_m_no',mobile_no_priority='$u_priority',website='$u_web',Facebook_ID='$u_fb_id' where user_id=$userid;");
	}
	
		include("background.php");
		
		$user_info_query=mysql_query("select * from user_info where user_id=$userid");
		$user_info_data=mysql_fetch_array($user_info_query);
?>
<html>

<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<title><?php echo $name; ?></title>
<link href="about_css/about.css" rel="stylesheet" type="text/css">
<script src="about_js/about.js"></script>
<link href="img/Faceback.jpg" rel="SHORTCUT ICON" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-theme.min.css" media="screen" rel="stylesheet" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="signin-form">
	<div class="container">
		<form id="login-form" class="form-signin" method="post">
			<h3 class="form-signin-heading" title="Know about <?php echo $name; ?> ">
			About (<?php echo $name; ?>)</h3>
			<hr />
			<h3 class="form-signin-heading"><span class="auto-style1" style="color:#800000"><a href="timeline.php">
			<span class="auto-style1">Timeline</span></a></span> <?php
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	$photos_count=mysql_num_rows($que_post_img);
	$photos_count=$photos_count+$count1+1;
?>| <a href="about.php" style="color: #800000;">About</a> |&nbsp;<a href="photos.php" style="color: #800000">Photos </a>(<?php echo $photos_count; ?>)</h3>
			<hr /><?php
	$que_post_img=mysql_query("select * from user_post where user_id=$userid and post_pic!='' order by post_id desc");
	$photos_count=mysql_num_rows($que_post_img);
	$photos_count=$photos_count+$count1+1;
?>
			<div>
				<h3><img src="img/about1.PNG">About : </h3>
				<hr />
				<h3></h3>
			</div>
			<!--Work and education-->
			<div>
				<h3>Work and education </h3>
			</div>
			<div id="work_static" onclick="work_static_hide()">
				<div>
&nbsp;</div>
				<?php
	$job=$user_info_data[1];
	$school_or_collage=$user_info_data[2];
	if($job!="")
	{
?>
				<div style="color: #000; font-weight: bold;">
					<?php echo $job; ?></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					<img src="img/job.PNG">Add a job </div>
				<?php	
    }
?>
				<div>
&nbsp;</div>
				<?php
	if($school_or_collage!="")
	{
?>
				<div style="color: #000; font-weight: bold;">
					<?php echo $school_or_collage; ?></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					<img src="img/school.PNG">Add a school or college </div>
				<?php
	}
?>
				<div style="position: absolute; left: 43.5%; top: 87.5%;">
&nbsp;</div>
				<input onclick="work_static_hide()" style="border-style: none; border-color: inherit; border-width: medium; background-image: url('img/edit_button.PNG'); height: 24; width: 51px;" type="button" value="             "></div>
		</form>
		<form id="Work_form" class="form-signin" method="post" style="display: none">
			<div style="color: #3B59A4;">
				Job </div>
			<div>
				<input maxlength="35" name="job" style="height: 33; width: 250; font-size: 16px;" type="text" value="<?php echo $job; ?>">
			</div>
			<div style="color: #3B59A4;">
				School or College </div>
			<div>
				<input maxlength="35" name="edu" style="height: 33; width: 250; font-size: 16px;" type="text" value="<?php echo $school_or_collage; ?>">
			</div>
			<div>
				<input class="save_button" name="work_sub" type="submit" value="Save">
			</div>
			<div>
				<input class="cancel_button" onclick="work_form_hide()" type="button" value="Cancel">
			</div>
		</form>
		<!--Living-->
		<div class="form-signin">
			<div>
				<h3>Living </h3>
			</div>
			<div id="Living_static" onclick="Living_static_hide()">
				<div>
&nbsp;</div>
				<?php
	$city=$user_info_data[3];
	if($city!="")
	{
?>
				<div style="color: #000; font-weight: bold; text-transform: capitalize;">
					<?php echo $city; ?></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					<img src="img/city.PNG">Add Your Current City </div>
				<?php
	}	
?>
				<div>
&nbsp;</div>
				<?php
	$hometown=$user_info_data[4];
	if($hometown!="")
	{
?>
				<div style="color: #000; font-weight: bold; text-transform: capitalize;">
					<?php echo $hometown; ?></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					<img src="img/hometown.PNG">Add your hometown </div>
				<?php
}
?>
				<div>
					<input onclick="Living_static_hide()" style="border-style: none; border-color: inherit; border-width: medium; background-image: url('img/edit_button.PNG'); height: 24; width: 51px;" type="button" value="             ">
				</div>
			</div>
			<form id="Living_form" method="post" style="display: none">
				<div style="color: #3B59A4;">
					Current City </div>
				<div>
					<input maxlength="15" name="city" onkeypress="return isStringKey(event)" style="height: 33; width: 250; font-size: 16px;" type="text" value="<?php echo $city; ?>">
				</div>
				<div style="color: #3B59A4;">
					hometown </div>
				<div>
					<input maxlength="15" name="hometown" onkeypress="return isStringKey(event)" style="height: 33; width: 250; font-size: 16px;" type="text" value="<?php echo $hometown; ?>">
				</div>
				<div>
					<input class="save_button" name="leving_sub" type="submit" value="Save">
				</div>
				<div>
					<input class="cancel_button" onclick="living_form_hide()" type="button" value="Cancel">
				</div>
			</form>
		</div>
		<!--Basic Information-->
		<div class="form-signin">
			<?php
	$user_data_query=mysql_query("select * from users where Email='$user'");
	$user_data=mysql_fetch_array($user_data_query);
	$bday=$user_data[5];
	$gender=$user_data[4];
	$Emial_id=$user_data[2];
?>
			<div>
				<h3>Basic Information </h3>
			</div>
			<div id="basic_static" onclick="basic_static_hide()">
				<div style="font-size: 18px; color: #89919C;">
					Birthday: <span style="color:Navy"><?php echo $bday; ?></span>  </div>
				<div style="font-size: 18px; color: #89919C;">
					Gender: <span style="color:Navy"><?php echo $gender; ?></span></div>
								<?php
	$relationship=$user_info_data[5];
	if($relationship!="")
	{	
?>
				<div style="font-size: 18px; color: #89919C;">
					Relationship: <span style="color:Navy"><?php echo $relationship; ?></span></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					Add Relationship </div>
				<?php
	}
?>
				<div>
					<input onclick="basic_static_hide()" style="border-style: none; border-color: inherit; border-width: medium; background-image: url('img/edit_button.PNG'); height: 24; width: 51px;" type="button" value="             ">
				</div>
			</div>
			<form id="basic_form" method="post" style="display: none">
				<div style="font-size: 18px; color: #89919C;">
					Birthday </div>
				<div>
					<select name="day" style="width: 61; font-size: 15px; height: 29; padding: 3;">
					<option value="Day:">Day:</option>
					<script type="text/javascript">
	
		for(i=1;i<=31;i++)
		{
			document.write("<option value='"+i+"'>" + i + "</option>");
		}
		
	</script>
					</select> </div>
				<div>
					<select name="month" style="width: 78; font-size: 15px; height: 29; padding: 3;">
					<option value="Month:">Month:</option>
					<script type="text/javascript">
	
		var m=new Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		for(i=1;i<=m.length-1;i++)
		{
			document.write("<option value='"+i+"'>" + m[i] + "</option>");
		}	
	</script>
					</select> </div>
				<div>
					<select name="year" style="width: 66; font-size: 15px; height: 29; padding: 3;">
					<option value="Year:">Year:</option>
					<script type="text/javascript">
	
		for(i=1996;i>=1960;i--)
		{
			document.write("<option value='"+i+"'>" + i + "</option>");
		}
	
	</script>
					</select> </div>
				<div style="font-size: 18px; color: #89919C;">
					Gender</div>
				<div style="font-size: 18px;">
					<?php echo $gender; ?></div>
				<div style="font-size: 18px; color: #89919C;">
					Relationship </div>
				<div>
					<select name="relationship" style="font-size: 15px; height: 29; padding: 3;">
					<option value="">------------</option>
					<script type="text/javascript">
	
		var rel=new Array("Single","In a relationship","Engaged","Married","Its complicated","In an open relationship","Windowed","Separated","Divoced");
		for(i=0;i<=rel.length-1;i++)
		{
			document.write("<option value='"+rel[i]+"'>" + rel[i] + "</option>");
		}	
	</script>
					</select> </div>
				<div>
					<input class="save_button" name="basic_sub" type="submit" value="Save">
				</div>
				<div>
					<input class="cancel_button" onclick="basic_form_hide()" type="button" value="Cancel">
				</div>
			</form>
		</div>
		<!--Contact Information-->
		<div class="form-signin">
			<div>
				<h3>Contact Information </h3>
			</div>
			<div id="contact_static" onclick="contact_static_hide()">
								<?php
	$m_no=$user_info_data[6];
	if($m_no!=0)
	{
?>
				<div  style="font-size: 18px; color: #89919C;">
					Mobile Phones: <span style="color:navy"><?php echo $m_no; ?></span> </div>
				<?php
		$m_no_priority=$user_info_data[7];
		if($m_no_priority=="Private")
		{
?>
								<?php			
		}
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					Add Mobile Number </div>
				<?php
	}
	?>
				<div style="font-size: 18px; color: #89919C;">
					Email: <span style="color:Navy"><?php echo $Emial_id; ?></span></div>
												<?php
	$web=$user_info_data[8];
	if($web!="")
	{
?>
								<?php
	}
	else
	{
?>
								<?php
	}
?>
								<?php
	$fb_id=$user_info_data[9];
	if($fb_id!="")
	{
?>
				<div style="font-size: 18px; color: #89919C;">
					Social Pic ID: <span style="color:Navy"><?php echo $fb_id; ?></span></div>
				<?php
	}
	else
	{
?>
				<div style="color: #3B59A4; font-weight: bold;">
					Add Social Pic ID </div>
				<?php
	}
?>
				<div>
					<input onclick="contact_static_hide()" style="border-style: none; border-color: inherit; border-width: medium; background-image: url('img/edit_button.PNG'); height: 24; width: 52px;" type="button" value="             ">
				</div>
			</div>
			<form id="contact_form" method="post" name="contact" onsubmit="return contact_check()" style="display: none">
				<div style="font-size: 18px; color: #89919C;">
					Mobile Phones </div>
				<div>
					<input maxlength="10" name="mno" onkeypress="return isNumberKey(event)" style="height: 33; width: 150; font-size: 16px;" type="text" value="<?php echo $m_no; ?>">
				</div>
				<div>
					<select name="priority" style="height: 33; font-size: 19px;">
					<option value="Private">Only me</option>
					<option value="Public">Public</option>
					</select> </div>
				<div style="font-size: 18px; color: #89919C;">
					Email</div>
				<div style="font-size: 18px;">
					<input disabled style="height: 33; width: 300; color: #000; font-size: 16px;" type="text" value="<?php echo $Emial_id; ?>"></div>
								<div style="font-size: 18px; color: #89919C;">
					Social CS ID </div>
				<div>
					<input maxlength="40" name="fbid" style="height: 33; width: 300; font-size: 16px;" type="text" value="<?php echo $fb_id; ?>">
				</div>
				<div>
					<input class="save_button" name="contact_sub" type="submit" value="Save">
				</div>
				<div>
					<input class="cancel_button" onclick="contact_form_hide()" type="button" value="Cancel">
				</div>
				<div id="mobile_no_erorr" style="display: none;">
					<img src="img/wrong.png"> The phone number is invalid.</div>
			</form>
			</form>
			<br>
		<hr><h3 class="form-signin-heading"> Settings</h3>
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
	    </div>
	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</div>

</body>

</html>
<?php
	}
	else
	{
		header("location:../../index.php");
	}
?>