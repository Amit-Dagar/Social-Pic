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
		
		if(isset($_POST['feedback']))
		{
			$fb_txt=$_POST['feedback_txt'];
			$star=$_POST['star'];
			$fb_time=$_POST['feedback_time'];
			mysql_query("insert into feedback(user_id,feedback_txt,star,Date) values($userid,'$fb_txt','$star','$fb_time')");
		}
		
		if(isset($_POST['delete_feedback']))
		{
			$fb_id=intval($_POST['feedback_id']);
			mysql_query("delete from feedback where feedback_id=$fb_id");
		}
		
		
		include("background.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="SHORTCUT ICON" HREF="img/Faceback.jpg" />
 <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>feeback- User Reviews</title>
<link href="Home_css/Home.css" rel="stylesheet" type="text/css"/>
	<script src="Home_js/home.js" language="javascript"></script>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css"  />
<style>
#feedback_button
{
	font-size:14px;
	height:30;
	width:80;
	padding:2;
	background-color:#5B74A8; color:#FFFFFF;
	border-top:#29447E;
	border-right-color:#29447E;
	border-bottom-color:#1A356E;
	border-left-color:#29447E;
	font-weight:bold;
}
</style>
<script>
	function blank_feedback_check()
	{
		var feedback_txt=document.feedback_form.feedback_txt.value;
		if(feedback_txt=="")
		{
			return false;
		}
		return true;
	}
	function feedback_name_underLine(fid)
	{
		document.getElementById("uname"+fid).style.textDecoration = "underline";
	}
	function feedback_name_NounderLine(fid)
	{
		document.getElementById("uname"+fid).style.textDecoration = "none"
	}
	
	function time_get()
	{
			d = new Date();
			mon = d.getMonth()+1;
			time = d.getDate()+"-"+mon+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
			feedback_form.feedback_time.value=time;
	}
</script>
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h4 class="form-signin-heading" title="Reviews Over Super Pic.">Reviews 
		Over Super Pic.</h4>
		   <p class="form-signin-heading" title="Reviews Over Super Pic."><hr>&nbsp;</p>
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
<section id="articles">
	<article id="article1">

<ul class="tab" style="height: 48px">
  <li style="height: 39px"><a href="../fb_home/Home.php" class="tablinks" onclick="openCity(event, 'Home')"><span style="color: blue">Home</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/photos.php" class="tablinks" onclick="openCity(event, 'My account')"><span style="color: blue">My account</span></a></li>
  <li style="height: 39px"><a href="../fb_profile/Profile_picture.php" class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
  <li style="height: 39px"><a href="../fb_home/feedback.php" class="tablinks" onclick="openCity(event, 'feedback')"><span style="color: blue">feedback</span></a></li>
  <li style="height: 39px"><a href="../fb_logout/logout.php" class="tablinks" onclick="openCity(event, 'Logout?')"><span style="color: blue">Logout?</span></a></li>
  <li style="height: 39px"><a href="../fb_home/Settings.php" class="tablinks" onclick="openCity(event, 'Settings')"><span style="color: blue">Account Settings</span></a></li>
</ul>
</article>
	</section>

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
		   <hr>
        
        
               <div> <img src="img/icon-feedback.png" height="74" width="89"/> </div>
	<div > <h2 style="color:Navy;"> Feedback </h2> </div>
    <hr/>
    
    <form class="form-signin" method="post" name="feedback_form" onSubmit="return blank_feedback_check()">
	
	<div>
		<textarea style="height:100; width:738px;" name="feedback_txt" maxlength="100" placeholder="What's on your mind?"></textarea>
	</div>	
    <div> <img src="img/star.png"/>
    	<select name="star" style=" font-size:16px; height:25; width:40;"> 
			<option value="5"> 5 </option> 
			<option value="4"> 4 </option> 
            <option value="3"> 3 </option> 
			<option value="2"> 2 </option>
            <option value="1"> 1 </option> 
		</select></div>
    <div>
    	&nbsp;</div>
    <input type="hidden" name="feedback_time"/>
    <div> 
		<input type="submit" value="feedback" name="feedback" id="feedback_button" onClick="time_get()" class="auto-style1"/>
		<br><br> 
    </div>
    <div><?php
		$que_feedback=mysql_query("select * from feedback order by feedback_id desc");
?>
    <div>
    <table border="0" style="width: 741px; height: 114px;">
<?php
	while($feedback_data=mysql_fetch_array($que_feedback))
	{
		$feedback_id=$feedback_data[0];
		$fb_user_id=$feedback_data[1];
		$fb_txt=$feedback_data[2];
		$fb_star=$feedback_data[3];
		$fb_time=$feedback_data[4];
		$que_fb_user_info=mysql_query("select * from users where user_id=$fb_user_id");
		$fb_user_data=mysql_fetch_array($que_fb_user_info);
		$user_name=$fb_user_data[1];
		$user_email=$fb_user_data[2];
		$user_gender=$fb_user_data[4];
		$que_fb_user_pic=mysql_query("select * from user_profile_pic where user_id=$fb_user_id");
		$fetch_user_pic=mysql_fetch_array($que_fb_user_pic);
		$user_pic=$fetch_user_pic[2];
?>
	<tr>
<?php    
    if($fb_user_id==$userid)
    {
?>
	<td colspan="7"align="right" style="border-top:outset; border-top-width:thin;"> 
			<form method="post">  
				<input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>" />
				<input type="submit" name="delete_feedback" value=" " style="background-color:#FFFFFF; border:#FFFFFF; background-image:url('img/delete_post.gif'); width:2%; height: 17px;"/> 
			</form>
     </td>
     <td>  </td>
<?php
	}
	else
	{
?>
	
          
			
<?php
	}
?>
			
     </tr>
    
	<tr>
    	<td style="padding-left:25; width: 130px;" rowspan="2"> <img src="../../fb_users/<?php echo $user_gender; ?>/<?php echo $user_email; ?>/Profile/<?php echo $user_pic; ?>" height="60" width="55"/> </td>
        <td colspan="2" style="padding:7; width: 268435552px;"> <a href="../fb_view_profile/view_profile.php?id=<?php echo $fb_user_id; ?>" style="text-transform:capitalize; text-decoration:none; color:#003399;" onMouseOver="feedback_name_underLine(<?php echo $feedback_id; ?>)" onMouseOut="feedback_name_NounderLine(<?php echo $feedback_id; ?>)" id="uname<?php echo $feedback_id; ?>"> <?php echo $user_name; ?> </a>   </td>
       
    </tr>
    <tr>
		<td colspan="2" style=" padding-left:7; width: 268435552px;">Review:-<?php echo $fb_txt; ?></td>
        	</tr>
    <tr>
		<td style="width: 130px">For went to TOP:<ul>
                        <li><a href="#article1">Top</a></li>
</ul></td>
        <td style=" padding-left:7;"> <span style="color:#999999;">  Give's <?php echo $fb_star; ?> star </span><span style="color:#999999;"> <?php echo $fb_time; ?> </span> </td>
        
    </tr>
<?php
	}
	
?>
   </table></div>
		</div>
    </form>
		<div>
    		<div class="form-signin" style="color=#800000"> 
				<a href="../fb_logout/logout.php">&nbsp;</a></a><div> 	   
	   <hr>
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
  <li style="height: 39px"><a href="../fb_profile/Profile_picture.php"class="tablinks" onclick="openCity(event, 'Profile')"><span style="color: blue">Profile</span></a></li>
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
	color: #FF0000;
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
	   <hr></div>


</div>
    
    </div>
         
        
                 </form>

    </div>
    
</div>

</body>
</html><?php
	}
	else
	{
		header("location:../../index.php");
	}
?>